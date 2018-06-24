<?php

namespace App\Listeners;

use App\Events\PostEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PostEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostEvent  $event
     * @return void
     */
//    public function handle(PostEvent $event)
//    {
//        //
//    }

    public function onDecrRedisTag($event){
        $event->post->tags()->each(function ($tag) {
            $tagArr = json_decode(Redis::HGET('tags',$tag->tag_id),true);
            $tagArr['number'] --;
            Redis::HSET('tags',$tag->tag_id,json_encode($tagArr));
        });
    }

    public function onIncrRedisTag($event){
        $event->post->tags()->each(function ($tag) {
            $tagArr = json_decode(Redis::HGET('tags',$tag->tag_id),true);
            $tagArr['number'] ++;
            Redis::HSET('tags',$tag->tag_id,json_encode($tagArr));
        });
    }

    public function onDecrOrIncrRedisTag($event){
        $new = collect($event->new);
        $old = collect($event->old);
//        return;
        $new->diff($old->all())->each(function($tag){
            $tagArr = json_decode(Redis::HGET('tags',$tag),true);
            $tagArr['number'] ++;
            Redis::HSET('tags',$tag,json_encode($tagArr));
        });

        $old->diff($new->all())->each(function($tag){
            $tagArr = json_decode(Redis::HGET('tags',$tag),true);
            $tagArr['number'] --;
            Redis::HSET('tags',$tag,json_encode($tagArr));
        });
    }

    public function subscribe($events){
        $events->listen(
            'App\Events\Post\Delete',
            'App\Listeners\PostEventSubscriber@onDecrRedisTag'
        );

        $events->listen(
            'App\Events\Post\Update',
            'App\Listeners\PostEventSubscriber@onDecrOrIncrRedisTag'
        );

        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onIncrRedisTag'
        );
        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onDecrRedisTag'
        );
    }
}
