<?php

namespace App\Providers;

use App\Models\Topic;
use App\Models\TopicComment;
use App\Observers\TopicObserver;
use Illuminate\Pagination\Paginator;
use App\Observers\TopicCommentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        Topic::observe(TopicObserver::class);
        TopicComment::observe(TopicCommentObserver::class);
    }
}
