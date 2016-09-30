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

    public function adSenses(){
        return $this->hasMany(AdSense::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function newsCount()
    {
        return $this->news()->count();
    }

    public function scopeColumnists($query){
        return $query->where('type', 'columnist');
    }

    public function scopeJournalists($query){
        return $query->where('type', 'journalist');
    }

    public function scopeAdmin($query){
        return $query->where('type', 'admin');
    }

    public function scopeColumnistsAndJournalists($query){
        return $query->where('type', 'columnist')->orWhere('type', 'journalist');
    }

}
