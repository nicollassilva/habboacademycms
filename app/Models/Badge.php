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

    protected const API_PAGINATION_LIMIT = 9;

    public static function defaultQuery()
    {
        return Badge::orderByDesc('id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges');
    }

    public static function resultsForApi(?string $search)
    {
        if(!$search) {
            return Badge::defaultQuery()
                ->paginate(self::API_PAGINATION_LIMIT);
        }

        return Badge::defaultQuery()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(self::API_PAGINATION_LIMIT);
    }
}
