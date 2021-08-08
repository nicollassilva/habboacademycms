<?php

namespace App\Http\Controllers\Dashboard\Topic;

use Illuminate\Http\Request;
use App\Models\Topic\TopicComment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = TopicComment::with(['user', 'topic'])
            ->latest()->paginate(30);

        return view('dashboard.topics.comments.index', [
            'comments' => $comments
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
        if(! $comment = TopicComment::with(['user', 'topic'])->find($id)) {
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
        if(! $comment = TopicComment::with(['user', 'topic'])->find($id)) {
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
    public function update($id, Request $request)
    {
        if(! $comment = TopicComment::find($id)) {
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
            ->route('adm.topics.comments.show', $comment->id)
            ->with('success', "Comentário editado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        $filteredComments = TopicComment::search($request->filter);

        return view('dashboard.topics.comments.index', [
            'comments' => $filteredComments,
            'filters' => $filters
        ]);
    }
}
