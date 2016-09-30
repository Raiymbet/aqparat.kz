<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdSense extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adsenses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'location', 'code', 'published'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function scopeSliderBottom($query){
        return $query->where('location', 'SliderBottom');
    }
    public function scopeSliderRight($query){
        return $query->where('location', 'SliderRight');
    }
    public function scopeRightSide($query){
        return $query->where('location', 'RightSide');
    }
    public function scopeColumnistRight($query){
        return $query->where('location', 'ColumnistRight');
    }
    public function scopePublished($query){
        return $query->where('published', true);
    }
}
