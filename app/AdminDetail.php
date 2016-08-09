<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['about', 'location', 'facebook', 'twitter', 'linkedIn', 'googlePlus'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['admin_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function admin()
    {
        $this->belongsTo(Admin::class);
    }
}
