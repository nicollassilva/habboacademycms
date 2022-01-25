<?php

namespace App\Models\Topic;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopicCategory extends Model
{
    use HasFactory;

    protected $table = 'topics_categories';

    protected $fillable = [
        'name', 'icon'
    ];
    
    public $timestamps = false;

    public function topics()
    {
        return $this->hasMany(Topic::class, 'category_id');
    }
}
