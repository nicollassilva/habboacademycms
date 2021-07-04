<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\TopicsCategories;
use App\Http\Controllers\Controller;

class AcademyController extends Controller
{
    public function index()
    {
        $topics = Topic::getListForIndex();
        $topicsCategories = TopicsCategories::all();

        return view('habboacademy.index', [
            'topics' => $topics,
            'topicsCategories' => $topicsCategories,
        ]);
    }
}
