<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Topic\TopicComment;
use Illuminate\Http\Request;

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
}
