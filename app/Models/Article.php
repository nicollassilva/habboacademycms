<?php

namespace App\Models;

use App\Models\Article\{
    ArticleComment,
    ArticleCategory
};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'description', 'slug', 'image_path',
        'content', 'reviewed', 'reviewer', 'status', 'fixed'
    ];

    protected $casts = [
        'reviewed' => 'boolean',
        'status' => 'boolean',
        'fixed' => 'boolean'
    ];

    protected const INDEX_PAGINATION_LIMIT = 8;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }

    public static function search($filter = null)
    {
        return Article::query()
            ->where(function($query) use ($filter) {
                return $query->where('title', 'LIKE', "%{$filter}%")
                             ->orWhere('description', 'LIKE', "%{$filter}%");
            })
            ->latest()
            ->paginate(35);
    }

    public static function getDefaultResources()
    {
        return Article::query()
            ->with(['user', 'category'])
            ->whereReviewed(true)
            ->whereStatus(true)
            ->whereFixed(false)
            ->latest()
            ->limit(self::INDEX_PAGINATION_LIMIT)
            ->get();
    }

    public static function getFixedResources()
    {
        return Article::query()
            ->with(['user', 'category'])
            ->whereReviewed(true)
            ->whereStatus(true)
            ->whereFixed(true)
            ->latest()
            ->limit(self::INDEX_PAGINATION_LIMIT)
            ->get();
    }

    public static function getArticle($id, $slug)
    {
        return Article::query()
            ->where('id', $id)
            ->whereSlug($slug)
            ->whereReviewed(true)
            ->whereStatus(true)
            ->first();
    }

    public static function getRelatedArticles(Article $article)
    {
        return Article::query()
            ->with(['user', 'category'])
            ->where('category_id', $article->category_id)
            ->where('id', '<>', $article->id)
            ->latest()
            ->limit(4)
            ->get();
    }
}