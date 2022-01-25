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
        $topic->slug = Str::kebab($topic->title);
    }
}
