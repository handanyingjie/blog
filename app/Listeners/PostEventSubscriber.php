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

    //有序队列
    public function onLPostsList($event)
    {
//        $this->redis->LPUSH('posts:list',$event->id);
        $this->redis->HSET($event->id, 'published_at', time());
        $this->redis->SADD('posts:list', $event->id);
    }

    public function onRemPostsList($event)
    {
        $this->redis->SREM('posts:list', $event->id);
    }


    public function subscribe($events)
    {
        //发布
        $events->listen(
            'App\Events\Post\Published',
            'App\Listeners\PostEventSubscriber@onLPostsList'
        );

//        $events->listen(
//            'App\Events\Post\Created',
//            'App\Listeners\PostEventSubscriber@onPostHSet'
//        );

        //取消发布
        $events->listen(
            'App\Events\Post\UnPublished',
            'App\Listeners\PostEventSubscriber@onRemPostsList'
        );
    }
}
