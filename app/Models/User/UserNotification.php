<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Services\Concerns\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotification extends Model
{
    use HasFactory;
    use Notification;

    protected $table = 'user_notifications';

    protected $fillable = [
        'from_user_id',
        'type',
        'slug',
        'title',
        'user_saw'
    ];

    protected $casts = [
        'user_saw' => 'boolean'
    ];

    public static function getDefault()
    {
        return auth()->user()
            ->notifications()
            ->orderBy('user_saw')
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
