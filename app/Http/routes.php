<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Task;
use Laravel\Socialite;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {

    /**
     *Басты бетті жаңалықтармен қайтару
     */
    Route::get('/','HomeController@getHome');
    Route::get('/currency', 'HomeController@currency_nbk_get_rates');
    Route::get('/about', 'HomeController@getAbout');
    Route::get('/columnist/{columnistId}', 'HomeController@getColumnist');

    Route::get('/login', 'SocialiteController@getLoginUserForm');
    Route::get('socialite/{provider?}', 'SocialiteController@getSocialiteAuth');
    Route::get('socialite/callback/{provider?}', 'SocialiteController@getSocialiteAuthCallback');
    Route::get('/logout', 'SocialiteController@logout');

    Route::get('/myposts', 'PostController@getMyPosts');
    Route::post('/post', 'PostController@store');
    Route::delete('/myposts/{post}', 'PostController@destroy');
    Route::post('/myposts/search', 'PostController@search');

    Route::get('/newsread/{newId}', 'NewController@getReadNew');
    Route::post('/newsread/{newId}', 'NewController@postComment');
    Route::get('/newsread/translate/{newId}', 'NewController@getTranslate');
    Route::get('/newsread/{newId}/islikedbyme', 'NewController@isLikedByMe');
    Route::post('/like/{new}', 'NewController@like');
    Route::get('/categorynews/{categoryId}', 'NewController@getCategoryNews');
    Route::get('/search', 'NewController@getSearch');
    Route::post('/search', 'NewController@postSearch');


    /**
     * Admin panel routes
     */
    Route::get('/admin/login', 'AdminAuth\AuthController@getLogin');
    Route::post('/admin/login', 'AdminAuth\AuthController@postLogin');
    Route::get('/admin/logout', 'AdminAuth\AuthController@getLogout');

    Route::get('/admin', 'AdminController@adminHome');
    Route::get('/admin/profile', 'AdminController@getProfile');
    Route::post('/admin/profile', 'AdminController@postProfile');

    Route::get('/admin/posts', 'AdminPostsController@getPosts');
    Route::get('/admin/posts/accept/{postId}', 'AdminPostsController@getAccept');
    Route::get('/admin/posts/ban/{postId}', 'AdminPostsController@getBan');
    Route::get('/admin/posts/processing/{postId}', 'AdminPostsController@getProcessing');
    Route::get('/admin/posts/delete/{postId}', 'AdminPostsController@getDestroy');
    Route::get('/admin/posts/writenew/{postId}', 'AdminPostsController@getWriteNew');

    Route::get('/admin/news', 'AdminNewsController@getNews');
    Route::get('/admin/news/delete/{newId}', 'AdminNewsController@getDestroy');
    Route::get('/admin/news/slider/{newId}', 'AdminNewsController@getSetAsSliderNew');
    Route::get('/admin/news/main/{newId}', 'AdminNewsController@getSetAsMainNew');
    Route::get('/admin/news/translate/{newId}', 'AdminNewsController@getTranslate');
    Route::post('/admin/news/translate/{newId}', 'AdminNewsController@postTranslateNew');
    Route::get('/admin/new/edit/{newId}', 'AdminNewsController@getEdit');
    Route::post('/admin/new/edit/{newId}', 'AdminNewsController@postEditNew');
    Route::get('/admin/new/add', 'AdminNewsController@getAddNew');
    Route::post('/admin/new/add', 'AdminNewsController@postAddNew');
    Route::get('/admin/new/search', 'AdminNewsController@getSearch');

    Route::get('/admin/comments', 'AdminCommentsController@getComments');
    Route::get('/admin/comments/delete/{commentId}', 'AdminCommentsController@getDestroy');
    Route::get('/admin/comments/ban/{commentId}', 'AdminCommentsController@getBan');

    Route::get('/admin/admins', 'AdminAdminsController@getAdmins');
    Route::get('/admin/admins/delete/{adminId}', 'AdminAdminsController@getDestroy');
    Route::post('/admin/admins', 'AdminAdminsController@postAdd');
    Route::post('/admin/admins/edit/{adminId}', 'AdminAdminsController@postEdit');

    Route::get('/admin/categories', 'AdminCategoriesController@getCategories');
    Route::post('/admin/categories', 'AdminCategoriesController@postAdd');
    Route::get('/admin/categories/delete/{categoryId}', 'AdminCategoriesController@getDestroy');
    Route::post('/admin/categories/edit/{categoryId}', 'AdminCategoriesController@postEdit');

});
