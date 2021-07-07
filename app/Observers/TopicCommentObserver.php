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
