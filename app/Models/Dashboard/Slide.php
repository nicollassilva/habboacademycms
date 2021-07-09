<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function search($filter = null)
    {
        return Slide::query()
            ->where(function($query) use ($filter) {
                return $query->where('title', 'LIKE', "%{$filter}%")
                             ->orWhere('description', 'LIKE', "%{$filter}%");
            })
            ->latest()
            ->paginate();
    }
}
