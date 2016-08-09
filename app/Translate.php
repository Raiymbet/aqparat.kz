<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['news_id', 'translate_id'];

    public function news(){
        return $this->belongsTo(News::class,'translate_id');
    }
}
