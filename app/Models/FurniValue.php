<?php

namespace App\Models;

use App\Models\Furni\FurniCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurniValue extends Model
{
    use HasFactory;

    protected $table = 'furni_values';

    protected $fillable = [
        'name', 'category_id', 'admin_id', 'price',
        'price_type', 'state', 'icon_path', 'image_path'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(FurniCategory::class);
    }
}
