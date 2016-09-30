<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 30.08.2016
 * Time: 13:17
 */

namespace App\NewSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Text implements Filter
{
    public static function apply(Builder $builder, $value){
        //dd($builder->where('text', 'LIKE', "%".$value."%")->get());
        return $builder->where('text', 'LIKE', '%'.$value.'%')
                        ->orWhere('title', 'LIKE', '%'.$value.'%');
    }
}