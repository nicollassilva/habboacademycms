<?php

namespace App\Http\Controllers\Web\Topic;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\TopicCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopic;

class TopicController extends Controller
{
    public function index()
    {

    }

    public function show($id, $slug, Request $request)
    {
        if(!$topic = Topic::whereSlug($slug)
            ->where('id', $id)
            ->with(['user', 'category'])
            ->withCount('comments')
            ->first()) {
            return redirect()->back();
        }

        $comments = $topic->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('habboacademy.topic', [
            'topic' => $topic,
            'comments' => $comments
        ]);
    }

    public function create()
    {
        $categories = TopicCategory::all();

        return view('habboacademy.users.topics.create', [
            'categories' => $categories
        ]);
    }

    public function store(StoreUpdateTopic $request)
    {
        $data = $request->all();

        $data['category_id'] = $data['category'];
        $data['content'] = nl2br(htmlspecialchars($data['content']));

        $user = \Auth::user();

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
