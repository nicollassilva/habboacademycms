<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User\UserBan;
use App\Models\User\UserLog;
use App\Models\Topic\TopicComment;
use App\Models\Traits\FilamentTrait;
use App\Models\User\UserNotification;
use App\Models\User\UserWarning;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasFactory, Notifiable, FilamentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'ip_register',
        'ip_last_login',
        'last_login',
        'password',
        'name',
        'profile_image_path',
        'disabled',
        'forum_signature'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'disabled' => 'boolean',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function logs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class, 'to_user_id');
    }

    public function bans()
    {
        return $this->hasMany(UserBan::class);
    }

    public function warnings()
    {
        return $this->hasMany(UserWarning::class);
    }
    
    public function topicComments()
    {
        return $this->hasMany(TopicComment::class);
    }

    public function getCommentsCount()
    {
        return $this->topicComments()->count();
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function checkLastTopicTime()
    {
        return $this->topics()
            ->where('created_at', '>', Carbon::now()->subMinutes(5))
            ->latest()
            ->limit(1)
            ->exists();
    }

    public function isAdmin()
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return Str::length($this->name, 'utf-8') > 3 ? $this->name : $this->username;
    }
}
