<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Topic\Topic;
use Illuminate\Http\Request;
use App\Models\Topic\TopicComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopicComment;

class TopicCommentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idTopic, $idComment)
    {
        if(! $comment = TopicComment::getCommentFromTopic($idTopic, $idComment)) {
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
    public function edit($idTopic, $idComment)
    {
        if(! $comment = TopicComment::getCommentFromTopic($idTopic, $idComment)) {
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
     * @param  \App\Http\Requests\StoreUpdateTopicComment  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($idTopic, $idComment, StoreUpdateTopicComment $request)
    {
        if(! $comment = TopicComment::getCommentFromTopic($idTopic, $idComment)) {
            return redirect()
                ->back()
                ->withErrors('Comentário não encontrado.');
        }

        $data = $request->only(['active', 'moderated']);

        if($request->moderated == 'moderated' && $comment->moderated == 'pending') {
            $data['moderator'] = \Auth::user()->username;
        }

        $comment->update($data);

        return redirect()
            ->route('adm.topic.comment.show', [$comment->topic->id, $comment->id])
            ->with('success', "Comentário editado com sucesso!");
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
