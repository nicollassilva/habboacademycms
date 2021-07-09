<?php

namespace App\Models\Topic;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopicComment extends Model
{
    use HasFactory;

    protected $table = "topics_comments";

    protected $fillable = [
        'content', 'active',
        'moderated', 'moderator'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function search($filter = null, $id)
    {
        return TopicComment::query()
            ->where('topic_id', $id)
            ->with('user')
            ->whereHas('user', function($query) use ($filter) {
                return $query->where('username', 'LIKE', "%{$filter}%");
            })
            ->latest()
            ->get();
    }

    public static function getCommentFromTopic($idTopic, $idComment)
    {
        return TopicComment::query()
            ->with(['topic', 'user'])
            ->where('topic_id', $idTopic)
            ->find($idComment);
    }
}
