<?php

namespace App\Http\Controllers\Web\Article;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($id, $slug)
    {
        if(! $article = Article::getArticle($id, $slug)) {
            return redirect()->route('web.academy.index');
        }

        $comments = $article->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        $relatedArticles = Article::getRelatedArticles($article);

        return view('habboacademy.article', [
            'article' => $article,
            'articles' => $relatedArticles,
            'comments' => $comments
        ]);
    }
}
