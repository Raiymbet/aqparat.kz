<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_id', 'news_id', 'reply'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userIsLikedComment($id){
        if ($this->likes()->where('deleted_at', null)->where('user_id', '=', $id)->exists()){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function news(){
        return $this->belongsTo(News::class);
    }

    public function likes(){
        return $this->belongsToMany('App\User','comment_likes');
    }

    public function likes_count(){
        return $this->likes()->where('deleted_at', null)->count();
    }

    public function commentLikes(){
        return $this->hasMany(CommentLikes::class);
    }

    public function replies(){
        return $this->hasMany(CommentReplies::class, 'comment_id', 'id')->orderBy('created_at', 'desc');
    }

    public function replies_count(){
        return $this->replies()->count();
    }

    public function scopeCommentsWithoutReplies($query){
        return $query->where('reply', false);
    }

}
