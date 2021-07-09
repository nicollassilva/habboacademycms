<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Topic\Topic;
use Illuminate\Http\Request;
use App\Models\Topic\TopicComment;
use App\Http\Controllers\Controller;

class TopicCommentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! $comment = TopicComment::with(['topic', 'user'])->find($id)) {
            return redirect()
                ->back()
                ->withErrors('Comentário não encontrado.');
        }

        return view('dashboard.topics.comments.show', [
            'comment' => $comment
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
        if(! $comment = TopicComment::find($id)) {
            return redirect()
                ->back()
                ->withErrors('Comentário não encontrado.');
        }

        return view('dashboard.topics.comments.edit', [
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($id);
    }

    /**
     * Display a listing of the filtered resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($id, Request $request)
    {
        if(! $topic = Topic::find($id)) {
            return redirect()
                ->route('adm.topics.index')
                ->withErrors('Tópico não encontrado');
        }

        $filters = $request->except('_token');

        $filteredComments = TopicComment::search($request->filter, $id);

        return view('dashboard.topics.comments.index', [
            'topic' => $topic,
            'comments' => $filteredComments,
            'filters' => $filters
        ]);
    }
}
