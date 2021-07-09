<?php

namespace App\Models\Topic;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'slug', 'category_id',
        'moderated', 'moderator', 'fixed', 'status'
    ];

    protected $casts = [
        'fixed' => 'boolean',
        'status' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TopicCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(TopicComment::class);
    }

    public static function getListForIndex()
    {
        return Topic::whereStatus(true)
            ->with('user')
            ->withCount('comments')
            ->orderBy('fixed', 'desc')
            ->latest()
            ->limit(8)
            ->get();
    }

    public static function getTopic($id, $slug)
    {
        return Topic::query()
            ->where('id', $id)
            ->whereSlug($slug)
            ->whereStatus(true)
            ->with(['user', 'category'])
            ->withCount('comments')
            ->first();
    }
}
