<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 14.07.2016
 * Time: 1:00
 */

namespace App\Repositories;

use App\News;
use App\SliderNew;
use App\Translate;

class NewRepository
{

    public function getLastNews(){
        return News::where('language', 'kz')->orderBy('created_at', 'desc')->take(15)->get();
    }

    public function getMoreReadedNews(){
        return News::where('language', 'kz')->orderBy('views', 'desc')->orderBy('created_at', 'desc')->take(15)->get();
    }

    public function getCategoryNews($id){
        return News::where('language', 'kz')->where('category_id', $id)->orderBy('created_at', 'desc')->simplePaginate(12);
    }

    public function getSliderNews(){
        return SliderNew::orderBy('updated_at', 'desc')->get();
    }

    public function getMainNews(){
        return News::where('language', 'kz')->where('ismainnew', true)->orderBy('created_at', 'desc')->simplePaginate(6);
    }

    public function getSearchNews($text, $category, $date){
        return News::where('language', '=', 'kz')
            ->where('text', 'LIKE', '%'.$text.'%')
            ->orWhere('title', 'LIKE', '%'.$text.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }
}