<?php

namespace App\Providers;

use App\Models\{
    Topic,
    Article
};
use App\Observers\{
    TopicObserver,
    TopicCommentObserver,
    ArticleObserver
};
use Filament\Facades\Filament;
use App\Models\Topic\TopicComment;
use Illuminate\Pagination\Paginator;
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
        
        Article::observe(ArticleObserver::class);
        Topic::observe(TopicObserver::class);
        TopicComment::observe(TopicCommentObserver::class);

        Filament::registerNavigationGroups([
            'Painel',
            'Academy',
            'Notícias',
            'Usuários',
            'Fórum'
        ]);
    }
}
