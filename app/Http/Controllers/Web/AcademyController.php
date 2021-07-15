<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic\Topic;
use App\Models\Dashboard\Slide;
use App\Models\Dashboard\Article;
use App\Models\Topic\TopicCategory;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\ArticleCategory;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getDefaultResources();
        $topicsCategories = TopicCategory::all();

        $articles = Article::getDefaultResources();
        $articlesCategories = ArticleCategory::all();

        $fixedArticles = Article::getFixedResources();
        $slides = Slide::latest()->limit(10)->get();

        return view('habboacademy.index', compact([
            'topics', 'topicsCategories', 
            'articles', 'articlesCategories', 'fixedArticles',
            'slides'
        ]));
    }
}
