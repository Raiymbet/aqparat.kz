<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 30.08.2016
 * Time: 13:06
 */

namespace App\NewSearch;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\NewSearch\Filters\Category;
use App\NewSearch\Filters\DateTime;
use App\NewSearch\Filters\Text;
use Illuminate\Pagination\LengthAwarePaginator;

class NewSearch
{
    public static function apply(Request $filters)
    {
        $query = static::applyDecoratorsFromRequest($filters, (new News)->newQuery());
        return $query;
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            //echo $filterName;
            //echo $value;
            $decorator = static::createFilterDecorator($filterName);
            //echo $decorator;
            if (static::isValidDecorator($decorator)) {
                //echo "Valid decorator";
                if(!$value == null){
                    $query = $decorator::apply($query, $value);
                }
            }

        }
        //echo '<br>';
        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . str_replace(' ', '',
            ucwords(str_replace('_', ' ', $name)));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function getResults(Builder $query)
    {
        return $query->get();
    }

}