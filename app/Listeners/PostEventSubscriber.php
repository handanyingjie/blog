<?php

namespace App\Listeners;

use App\Events\PostEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PostEventSubscriber
{
    private $redis;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redis = Redis::connection('default');
    }

    /**
     * Handle the event.
     *
     * @param  PostEvent $event
     * @return void
     */
//    public function handle(PostEvent $event)
//    {
//        //
//    }

    public function onDecrRedisTag($event)
    {
        $event->post->tags()->each(function ($tag) {
            $tagArr = json_decode($this->redis->HGET('tags', $tag->tag_id), true);
            $tagArr['number']--;
            $this->redis->HSET('tags', $tag->tag_id, json_encode($tagArr));
        });
    }

    public function onIncrRedisTag($event)
    {
        $event->post->tags()->each(function ($tag) {
            $tagArr = json_decode($this->redis->HGET('tags', $tag->tag_id), true);
            $tagArr['number']++;
            $this->redis->HSET('tags', $tag->tag_id, json_encode($tagArr));
        });
    }

    public function onDecrOrIncrRedisTag($event)
    {
        $new = collect($event->new);
        $old = collect($event->old);

        $new->diff($old->all())->each(function ($tag) {
            $tagArr = json_decode($this->redis->HGET('tags', $tag), true);
            $tagArr['number']++;
            $this->redis->HSET('tags', $tag, json_encode($tagArr));
        });

        $old->diff($new->all())->each(function ($tag) {
            $tagArr = json_decode($this->redis->HGET('tags', $tag), true);
            $tagArr['number']--;
            $this->Redis->HSET('tags', $tag, json_encode($tagArr));
        });
    }

    //有序队列
    public function onPostZADD($event)
    {
        $this->redis->LPUSH('newPosts', 'post:' . $event->post->id);
        $this->redis->LTRIM('newPosts', 0, 1000);
    }

    public function onPostZREM($event)
    {
        $this->redis->LREM('newPosts', 0,'post:'.$event->post->id);
    }

    //文章
    public function onPostHSet($event)
    {
        $this->redis->HMSET('post:' . $event->post->id, $event->post->toArray());
    }

    public function onPostHDEL($event)
    {
        $this->redis->DEL('post:' . $event->post->id);
    }

    //文章_标签
    public function onPostsTagsHSETPush($event)
    {
        $event->post->tags()->each(function ($item) {
            $old = json_decode(Redis::HGET('posts_tags', $item->tag_id), true);
            Redis::HSET('posts_tags', $item->tag_id, json_encode(collect($old)->push($item->taggable_id)->unique()->toArray()));
        });
    }

    public function onPostsTagsHSETDel($event)
    {
        $event->post->tags()->each(function ($item) {
            $old = json_decode(Redis::HGET('posts_tags', $item->tag_id), true);
            $new = collect($old)->reject(function ($value) use ($item) {
                return $value == $item->taggable_id;
            });
            Redis::HSET('posts_tags', $item->tag_id, json_encode($new->all()));
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Post\Delete',
            'App\Listeners\PostEventSubscriber@onDecrRedisTag'
        );

        $events->listen(
            'App\Events\Post\Update',
            'App\Listeners\PostEventSubscriber@onDecrOrIncrRedisTag'
        );

        //发布
        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onIncrRedisTag'
        );

        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onPostZADD'
        );

        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onPostHSet'
        );
        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onPostsTagsHSETPush'
        );
//        $events->listen(
//            'App\Events\Post\Created',
//            'App\Listeners\PostEventSubscriber@onPostHSet'
//        );

        //取消发布
        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onDecrRedisTag'
        );

        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onPostZREM'
        );
        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onPostHDEL'
        );
        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onPostsTagsHSETDel'
        );
    }
}
