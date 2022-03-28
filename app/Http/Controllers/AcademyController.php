<?php

namespace App\Http\Controllers;

use App\Models\{
    Topic, Slide,
    Topic\TopicCategory,
};
use App\Http\Controllers\Controller;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getDefaultResources();
        $slides = Slide::getDefaultResources();
        $topicsCategories = TopicCategory::all();

        return view('habboacademy.index',
            compact([
                'topics',
                'slides',
                'topicsCategories',
            ])
        );
    }
}
