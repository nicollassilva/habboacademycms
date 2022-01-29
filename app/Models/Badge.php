<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    public static $rarities = [
        'normal' => 'Normal',
        'event' => 'Evento',
        'promo' => 'Promoção',
        'very' => 'Muito Raro',
        'staff' => 'Staff'
    ];

    protected $fillable = [
        'title',
        'description',
        'code',
        'image_path',
        'rarity',
        'content_slug'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges');
    }
}
