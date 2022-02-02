<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Topic\TopicCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTopic;

class TopicController extends Controller
{
    public function show(Request $request, $id, $slug)
    {
        if (!$topic = Topic::getTopic($id, $slug)) {
            return redirect()->route('web.academy.index');
        }

        if($request->query('fromNotification') && $topic->user_id === \Auth::id()) {
            $allNotificationsFromTopic = \Auth::user()->getNotificationsByTopic($topic);

            $allNotificationsFromTopic->each(function($notification) {
                $notification->update(['user_saw' => true]);
            });
        }

        $comments = $topic->comments()
            ->with(['user', 'user.badges'])
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
        $data = $request->only(['title', 'content', 'slug', 'category']);

        $data['category_id'] = $data['category'];
        $data['content'] = nl2br(htmlspecialchars($data['content']));

        $user = \Auth::user();

        if ($user->checkLastTopicTime()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Espere 5 minutos para postar um novo tópico!');
        }

        $user->topics()->create($data);

        return redirect()
            ->back()
            ->with('success', 'Tópico criado com sucesso!');
    }
}
