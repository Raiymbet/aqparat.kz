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
    protected $hidden = ['user_id', 'news_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function news(){
        return $this->belongsTo(News::class);
    }

}
