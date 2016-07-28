<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderNew extends Model
{

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['new_id'];

    public function news(){
        return $this->belongsTo(News::class);
    }
}
