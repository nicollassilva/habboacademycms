<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic\Topic;
use App\Models\Dashboard\Article;
use App\Models\Topic\TopicCategory;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\ArticleCategory;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getResourcesForIndexPage();
        $topicsCategories = TopicCategory::all();

        $articles = Article::getResourcesForIndexPage();
        $articlesCategories = ArticleCategory::all();

        return view('habboacademy.index', [
            'topics' => $topics,
            'topicsCategories' => $topicsCategories,
            'articles' => $articles,
            'articlesCategories' => $articlesCategories,
        ]);
    }
}
