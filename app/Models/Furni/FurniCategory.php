<?php

namespace App\Models\Furni;

use App\Models\FurniValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurniCategory extends Model
{
    use HasFactory;

    protected $table = 'furni_categories';

    public $timestamps = false;

    protected $fillable = [
        'name', 'icon'
    ];

    public function furnis()
    {
        return $this->hasMany(FurniValue::class, 'category_id');
    }
}
