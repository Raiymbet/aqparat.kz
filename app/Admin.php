<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function adminDetails()
    {
        return $this->hasOne(AdminDetail::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function newsCount()
    {
        return $this->news()->count();
    }
}
