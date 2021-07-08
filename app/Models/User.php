<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Topic\Topic;
use App\Models\Dashboard\Article;
use App\Models\Topic\TopicComment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'name', 'profile_image_path'
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
        'email_verified_at' => 'datetime'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    
    public function topicComments()
    {
        return $this->hasMany(TopicComment::class);
    }

    public function getCommentsCount()
    {
        return $this->topicComments()->count();
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
}
