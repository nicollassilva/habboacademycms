<?php

namespace App\Observers;

use App\Models\Topic\TopicComment;

class TopicCommentObserver
{
    /**
     * Handle the TopicComment "creating" event.
     *
     * @param  \App\Models\Topic\TopicComment  $topicComment
     * @return void
     */
    public function creating(TopicComment $topicComment)
    {
        $topicComment->user_id = \Auth::id();
    }

    /**
     * Handle the TopicComment "created" event.
     *
     * @param  \App\Models\Topic\TopicComment  $topicComment
     * @return void
     */
    public function created(TopicComment $topicComment)
    {
        $topicComment->user->increment('topics_comment_count');
        $topicComment->topic->increment('comments_count');

        $topic = $topicComment->topic;

        // O usuário que comentou é o dono do tópico
        if($topic->user->id === \Auth::id()) return;
        $authUser = \Auth::user();

        $topic->user->notifications()->create([
            'from_user_id' => \Auth::id(),
            'type' => 'comment',
            'title' => "{$authUser->username} comentou no seu tópico \"{$topicComment->topic->title}\"",
            'slug' => route('web.topics.show', ['id' => $topic->id, 'slug' => $topic->slug])
        ]);
    }

    /**
     * Handle the TopicComment "updating" event.
     *
     * @param  \App\Models\Topic\TopicComment  $topicComment
     * @return void
     */
    public function updating(TopicComment $topicComment)
    {
        $topicComment->user_id = \Auth::id();
    }
}
