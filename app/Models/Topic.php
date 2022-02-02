<?php

namespace App\Models;

use App\Models\Topic\{
    TopicComment,
    TopicCategory
};
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
        return $this->hasMany(TopicComment::class)->latest();
    }

    public static function getDefaultResources()
    {
        return Topic::query()
            ->whereStatus(true)
            ->with('user')
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
            ->with(['user', 'user.badges', 'category'])
            ->first();
    }

    public static function search($filter = null)
    {
        return Topic::query()
            ->where('title', 'LIKE', "%{$filter}%")
            ->latest()
            ->paginate(30);
    }
}
