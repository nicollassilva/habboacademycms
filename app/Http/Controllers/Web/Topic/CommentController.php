<?php

namespace App\Http\Controllers\Web\Topic;

use App\Models\Topic\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store($id, $slug, Request $request)
    {
        if(!$topic = Topic::whereSlug($slug)->where('id', $id)->with(['user', 'category'])->first()) {
            return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'content' => ['required', 'min:6', 'max:5000']
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()->withInput()->withErrors($validator);
        }

        $topic->comments()->create($request->all());

        return redirect()
            ->back()->with('success', 'Comentário criado com sucesso!');
    }
}
