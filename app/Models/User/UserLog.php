<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'users_logs';

    protected $fillable = [
        'ip', 'browser', 'content'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
