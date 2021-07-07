<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic\Topic;
use Illuminate\Http\Request;
use App\Models\Topic\TopicCategory;
use App\Http\Controllers\Controller;
use App\Models\User;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getListForIndex();
        $topicsCategories = TopicCategory::all();

        return view('habboacademy.index', [
            'topics' => $topics,
            'topicsCategories' => $topicsCategories
        ]);
    }
}
