<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReplies extends Model
{
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['comment_id', 'replied_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function comment(){
        return $this->belongsTo(Comment::class, 'replied_id', 'id');
    }
}
