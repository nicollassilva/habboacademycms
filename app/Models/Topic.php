<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'slug', 'category_id'
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
        return $this->belongsTo(TopicsCategories::class);
    }

    public static function getListForIndex()
    {
        return Topic::whereStatus(true)
            ->with('user')
            ->orderBy('fixed', 'desc')
            ->latest()
            ->limit(8)
            ->get();
    }
}
