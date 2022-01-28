<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBan extends Model
{
    use HasFactory;

    protected $table = 'users_bans';

    protected $fillable = [
        'user_id', 'admin_id', 'type', 'reason', 'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public static function userHasBeenIpBanned()
    {
        return User::where('ip_register', \Request::ip())
            ->limit(1)
            ->whereHas('bans', function ($query) {
                return $query->whereType('ip')
                    ->where(function ($query) {
                        return $query->whereNull('expires_at')
                            ->orWhereDate('expires_at', '>', \Carbon\Carbon::now());
                    });
            })->exists();
    }
}
