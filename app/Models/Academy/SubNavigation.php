<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubNavigation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'label',
        'slug',
        'new_tab',
        'order'
    ];

    protected $casts = [
        'visible' => 'boolean',
        'new_tab' => 'boolean'
    ];

    public function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }
}
