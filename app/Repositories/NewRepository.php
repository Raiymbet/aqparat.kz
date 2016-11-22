<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 14.07.2016
 * Time: 1:00
 */

namespace App\Repositories;

use App\Admin;
use App\News;
use App\SliderNew;
use App\Translate;

class NewRepository
{

    public function getLastNews($count){
        return News::where('language', 'kz')->where('published', true)->orderBy('created_at', 'desc')->simplePaginate($count);
    }

    public function getMoreReadedNews($count){
        return News::where('language', 'kz')->where('published', true)->orderBy('views', 'desc')->orderBy('created_at', 'desc')->simplePaginate($count);
    }

    public function getFocuses($count, $array_ids){
        return News::where('language', 'kz')->where('published', true)->whereIn('category_id', $array_ids)->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function getRoundTables($count, $array_ids){
        return News::where('language', 'kz')->where('published', true)->whereIn('category_id', $array_ids)->orderBy('created_at', 'desc')->take($count)->get();
    }

    public function getCategoryNewsForSlider($id){
        return News::where('language', 'kz')->where('published', true)->where('category_id', $id)->orderBy('created_at', 'desc')->take(5)->get();
    }

    public function getCategoryNews($id, $count){
        return News::where('language', 'kz')->where('category_id', $id)->where('published', true)->orderBy('created_at', 'desc')->skip(5)->simplePaginate($count);
    }

    public function getColumnistNews($id, $count){
        return Admin::find($id)->news()->where('language', 'kz')->where('published', true)->orderBy('created_at', 'desc')->simplePaginate($count);
    }

    public function getCategoryAdvancedNews($array_ids){
        return News::where('language', 'kz')->where('published', true)
            ->whereIn('category_id', $array_ids)
            ->orderBy('views', 'desc')
            ->orderBy('likes', 'desc')
            ->groupBy('category_id')
            ->take(8)
            ->get();
    }

    public function getSliderNews(){
        return SliderNew::orderBy('updated_at', 'desc')->get();
    }

    public function getMainNews(){
        return News::where('language', 'kz')->where('published', true)->where('ismainnew', true)->orderBy('created_at', 'desc')->simplePaginate(18);
    }

    public function getSearchNews($text, $category, $date){
        return News::where('language', '=', 'kz')->where('published', true)
            ->where('text', 'LIKE', '%'.$text.'%')
            ->orWhere('title', 'LIKE', '%'.$text.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getRecommendNews(News $new){
        return News::where('language', '=', 'kz')->where('published', true)
            ->where('category_id', $new->category->id)
            ->where('id', '!=', $new->id)
            ->orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
    }

    public function getRecommendedNews(){
        return News::where('language', '=', 'kz')->where('published', true)
            ->orderBy('views', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
    }
}