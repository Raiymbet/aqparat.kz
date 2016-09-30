<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 30.08.2016
 * Time: 13:22
 */

namespace App\NewSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value);
}