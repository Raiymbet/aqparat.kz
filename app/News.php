<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'text', 'language'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['author_id', 'category_id', 'views', 'shares', 'likes', 'ismainnew'];

    public function posts(){
        return $this->hasOne(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function comments_count(){
        return $this->comments()->count();
    }

    public function likes(){
        return $this->belongsToMany('App\User', 'likes');
    }

    public function SliderNew(){
        return $this->hasOne(SliderNew::class);
    }

    public function translates(){
        return $this->hasMany(Translate::class, 'news_id');
    }
}
