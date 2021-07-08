<?php

namespace App\Models\Dashboard;

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
}
