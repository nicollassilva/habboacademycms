<?php

namespace App\Models\Article;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'articles_categories';

    protected $fillable = [
        'name', 'icon'
    ];

    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public static function search($filter = null)
    {
        return ArticleCategory::query()
            ->where('name', 'LIKE', "%{$filter}%")->latest('id')->paginate(30);
    }
}
