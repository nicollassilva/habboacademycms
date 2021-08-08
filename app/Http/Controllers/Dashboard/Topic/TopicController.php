<?php

namespace App\Http\Controllers\Dashboard\Topic;

use App\Models\Topic\Topic;
use Illuminate\Http\Request;
use App\Models\Topic\TopicCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with('user')->latest()->paginate(30);

        return view('dashboard.topics.index', [
            'topics' => $topics
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $topic = Topic::with(['user', 'category'])->find($id)) {
            return redirect()
                ->route('adm.topics.index')
                ->withErrors('Tópico não encontrado');
        }

        return view('dashboard.topics.show', [
            'topic' => $topic
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(! $topic = Topic::with(['user', 'category'])->find($id)) {
            return redirect()
                ->route('adm.topics.index')
                ->withErrors('Tópico não encontrado');
        }

        return view('dashboard.topics.edit', [
            'topic' => $topic,
            'categories' => TopicCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTopic  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTopic $request, $id)
    {
        if(! $topic = Topic::with(['user', 'category'])->find($id)) {
            return redirect()
                ->route('adm.topics.index')
                ->withErrors('Tópico não encontrado');
        }

        $data = $request->only(['title', 'category', 'status', 'fixed', 'moderated']);

        if($topic->moderated != 'moderated' && $request->moderated == 'moderated') {
            $data['moderator'] = \Auth::user()->username;
        }

        $topic->update($data);

        return redirect()
            ->route('adm.topics.index')
            ->with('success', 'Tópico editado com sucesso!');
    }

    /**
     * Display the comments of specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comments($id)
    {
        if(! $topic = Topic::with(['comments', 'comments.user'])->find($id)) {
            return redirect()
                ->route('adm.topics.index')
                ->withErrors('Tópico não encontrado');
        }

        return view('dashboard.topics.topic_comments.index', [
            'topic' => $topic,
            'comments' => $topic->comments
        ]);
    }

    /**
     * Display a listing of the filtered resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $filteredTopics = Topic::search($request->filter);

        return view('dashboard.topics.index', [
            'topics' => $filteredTopics,
            'filters' => $filters
        ]);
    }
}
