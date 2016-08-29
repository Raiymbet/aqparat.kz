<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type'];

    public function news(){
        return $this->hasMany(News::class);
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOfExceptCategory($query, $type, $id){
        return $query->where('type', $type)->where('id', '!=', $id);
    }

    public function latestNewsPerCategory(){
        return $this->news()->latest()->nPerGroup('category_id', 3);
    }
}
