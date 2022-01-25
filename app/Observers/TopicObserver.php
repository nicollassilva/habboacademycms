<?php

namespace App\Observers;

use App\Models\Topic;
use Illuminate\Support\Str;

class TopicObserver
{
    /**
     * Handle the Topic "creating" event.
     *
     * @param  \App\Models\Topic\Topic  $topic
     * @return void
     */
    public function creating(Topic $topic)
    {
        $topic->slug = Str::kebab($topic->title);
    }

    /**
     * Handle the Topic "updating" event.
     *
     * @param  \App\Models\Topic\Topic  $topic
     * @return void
     */
    public function updating(Topic $topic)
    {
        $topicModerated = ['closed', 'moderated'];

        $topic->slug = Str::kebab($topic->title);

        if(empty($topic->moderator) && in_array($topic->moderated, $topicModerated)) {
            $topic->moderator = \Auth::user()->username;
        }
    }
}
