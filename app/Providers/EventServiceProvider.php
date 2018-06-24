<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Post\Delete' => [
//            'App\Listeners\PostEventSubscriber',
//        ],
//        'App\Events\Post\Published' => [
//            'App\Listeners\PostEventSubscriber',
//        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

    protected $subscribe = [
        'App\Listeners\PostEventSubscriber'
    ];
}
