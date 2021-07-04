<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic;
use App\Models\TopicsCategories;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopic;

class TopicController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $categories = TopicsCategories::all();

        return view('habboacademy.layouts.user.topics.create', [
            'categories' => $categories
        ]);
    }

    public function store(StoreUpdateTopic $request)
    {
        $data = $request->all();

        $data['category_id'] = $data['category'];

        $user = auth()->user();

        if($user->checkLastTopicTime()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Espere 5 minutos para postar um novo tópico!');
        }

        $topic = $user->topics()->create($data);

        return redirect()
                ->back()
                ->with('success', 'Tópico criado com sucesso!');
    }
}
