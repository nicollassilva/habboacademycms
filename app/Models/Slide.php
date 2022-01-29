<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'slug', 'active',
        'image_path', 'fixed', 'new_tab'
    ];

    protected $casts = [
        'active' => 'boolean',
        'fixed' => 'boolean',
        'new_tab' => 'boolean'
    ];

    public static function getDefaultResources()
    {
        return Slide::query()
            ->whereActive(true)
            ->orderByDesc('fixed')
            ->orderByDesc('id')
            ->limit(10)
            ->get();
    }
}
