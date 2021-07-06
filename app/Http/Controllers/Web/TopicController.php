<?php

namespace App\Http\Controllers\Web;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\TopicCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopic;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function index()
    {

    }

    public function show($id, $slug, Request $request)
    {
        if(!$topic = Topic::whereSlug($slug)->where('id', $id)->with(['user', 'category'])->first()) {
            return redirect()->back();
        }

        return view('habboacademy.topic', [
            'topic' => $topic
        ]);
    }

    public function create()
    {
        $categories = TopicCategory::all();

        return view('habboacademy.layouts.user.topics.create', [
            'categories' => $categories
        ]);
    }

    public function store(StoreUpdateTopic $request)
    {
        $data = $request->all();

        $data['category_id'] = $data['category'];
        $data['content'] = nl2br(htmlspecialchars($data['content']));

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

    public function storeComment($id, $slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => ['required', 'min:6', 'max:5000']
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()->withInput()->withErrors($validator);
        }

        if(!$topic = Topic::whereSlug($slug)->where('id', $id)->with(['user', 'category'])->first()) {
            return redirect()->back();
        }

        $topic->comments()->create($request->all());

        return redirect()
            ->back()->with('success', 'Comentário criado com sucesso!');
    }
}
