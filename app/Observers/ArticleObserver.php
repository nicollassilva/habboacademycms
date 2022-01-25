<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    /**
     * Handle the Article "creating" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->slug = Str::kebab($article->title);
        $article->user_id = \Auth::id();
    }

    /**
     * Handle the Article "updating" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        $article->slug = Str::kebab($article->title);
        $article->user_id = \Auth::id();
    }
}
