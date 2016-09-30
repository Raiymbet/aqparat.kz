<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'provider',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Получить все posts пользователя.
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->belongsToMany('App\News', 'likes', 'user_id', 'news_id');
    }

    public function comment_likes(){
        return $this->belongsToMany('App\Comment', 'comment_likes', 'user_id', 'comment_id');
    }

    //1 User has Many Notifications
    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    //to retrieve new Notification
    public function newNotification(){

        $notification = new Notification;
        $notification->user()->associate($this);

        return $notification;
    }

}
