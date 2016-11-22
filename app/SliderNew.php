<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderNew extends Model
{
    protected $fillable = ['new_id'];

    public function news(){
        return $this->hasOne(News::class,'id', 'new_id');
    }
}
