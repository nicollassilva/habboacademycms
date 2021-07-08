<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Dashboard\Article;

class ArticleObserver
{
    /**
     * Handle the Article "creating" event.
     *
     * @param  \App\Models\Dashboard\Article  $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->slug = Str::kebab($article->title);
    }

    /**
     * Handle the Article "updating" event.
     *
     * @param  \App\Models\Dashboard\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        $article->slug = Str::kebab($article->title);
    }
}
