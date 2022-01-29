<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Navigation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'label',
        'small_icon',
        'hover_icon',
        'slug',
        'order'
    ];

    public function subNavigations()
    {
        return $this->hasMany(SubNavigation::class);
    }
}
