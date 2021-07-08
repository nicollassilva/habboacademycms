<?php

namespace App\Models\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'description', 'slug', 'image_path', 'content'
    ];

    protected $casts = [
        'reviewed' => 'boolean',
        'status' => 'boolean',
        'fixed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
