<?php

namespace App\Providers;

use App\Models\Post;
use App\Observes\PostObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);

        Gate::define('create-post', function ($user) {
            return $user->hasAccess('create-post');
        });
        Gate::define('update-post', function ($user, Post $post) {
            return $user->hasAccess('update-post') or $user->id == $post->user_id;
        });
        Gate::define('publish-post', function ($user, Post $post) {
            return $user->hasAccess('publish-post') or $user->id == $post->user_id;
        });
        Gate::define('delete-post', function ($user, Post $post) {
            return $user->hasAccess('delete-post') or $user->id == $post->user_id;
        });
        Gate::define('see-all-drafts', function ($user) {
            return $user->inRole('editor');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
