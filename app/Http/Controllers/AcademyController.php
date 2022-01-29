<?php

namespace App\Http\Controllers;

use App\Models\{
    Topic, Slide, Article,
    Topic\TopicCategory,
    Article\ArticleCategory
};
use App\Http\Controllers\Controller;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getDefaultResources();
        $topicsCategories = TopicCategory::all();

        $articles = Article::getDefaultResources();
        $articlesCategories = ArticleCategory::all();

        $fixedArticles = Article::getFixedResources();
        $slides = Slide::getDefaultResources();

        return view('habboacademy.index',
            compact([
                'topics',
                'topicsCategories', 
                'articles',
                'articlesCategories',
                'fixedArticles',
                'slides'
            ])
        );
    }
}
