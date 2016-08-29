<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['biography', 'location', 'facebook', 'twitter', 'linkedIn', 'googlePlus'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
