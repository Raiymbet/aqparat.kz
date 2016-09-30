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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {

    /**
     *Басты бетті жаңалықтармен қайтару
     */
    Route::get('/','HomeController@getHome');
    Route::get('/currency', 'HomeController@currency_nbk_get_rates');
    Route::get('/about', 'HomeController@getAbout');
    Route::get('/contactus', 'HomeController@getContact');
    Route::get('/google18945143611ffadd.html', 'HomeController@getGoogleSiteConfirm');

    Route::get('/columnist/{columnistId}', 'HomeController@getColumnist');
    Route::get('/roundtable/{categoryId}', 'HomeController@getRoundTable');
    Route::get('/onfocus/{categoryId}', 'HomeController@getFocus');

    Route::get('/comments', 'HomeController@getMyComments');
    Route::get('/profile', 'HomeController@getMyProfile');
    Route::get('/profile/{userId}', 'HomeController@getUserProfile');
    Route::post('/profile', 'HomeController@postProfile');

    Route::get('/login', 'SocialiteController@getLoginUserForm');
    Route::get('socialite/{provider?}', 'SocialiteController@getSocialiteAuth');
    Route::get('socialite/callback/{provider?}', 'SocialiteController@getSocialiteAuthCallback');
    Route::get('/logout', 'SocialiteController@logout');

    Route::get('/myposts', 'PostController@getMyPosts');
    Route::post('/post', 'PostController@store');
    Route::post('/post/edit', 'PostController@edit');
    Route::delete('/myposts/{post}', 'PostController@destroy');
    //Route::post('/myposts/search', 'PostController@search');

    Route::get('/newsread/{newId}', 'NewController@getReadNew');
    Route::get('/print/{newId}', 'NewController@getPrint');
    Route::get('/newsread/translate/{newId}', 'NewController@getTranslate');
    Route::get('/newsread/{newId}/islikedbyme', 'NewController@isLikedByMe');
    Route::post('/like/{new}', 'NewController@like');
    Route::get('/categorynews/{categoryId}', 'NewController@getCategoryNews');
    
    Route::get('/search', 'NewController@getSearch');
    Route::get('/search/new', 'NewController@postSearch');

    Route::get('/news/ajax/{type}', 'NewController@getNewsPaginate' );

    Route::get('/comment/{type}/{commentId}', 'NewController@getComment');
    Route::get('/newsread/comments/{newId}', 'NewController@getComments');
    Route::get('/newsread/replies/{commentId}', 'NewController@getReplies');
    Route::get('/newsread/notifications/read', 'NotificationController@readNotifications');
    Route::post('/newsread/{newId}', 'CommentController@postComment');
    Route::post('/comment/like/{comment}', 'CommentController@like');


    /**
     * Admin panel routes
     */
    Route::get('/admin/login', 'AdminAuth\AuthController@getLogin');
    Route::post('/admin/login', 'AdminAuth\AuthController@postLogin');
    Route::get('/admin/logout', 'AdminAuth\AuthController@getLogout');

    Route::get('/admin', 'AdminController@adminHome');
    Route::get('/admin/profile', 'AdminController@getProfile');
    Route::get('/admin/users', 'AdminController@getUsers');
    Route::post('/admin/profile', 'AdminController@postProfile');
    Route::post('/admin/image/upload', 'AdminController@postImageUpload');

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
    Route::post('/admin/new/trash/clean', 'AdminController@postTrashClean');
    Route::get('/admin/news/preview', 'AdminController@getPreview');

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

    Route::get('/admin/messaging', 'AdminMessagingController@getMessaging');
    Route::post('/admin/messaging', 'AdminMessagingController@postMessaging');

    Route::get('/admin/adSense', 'AdminAdSenseController@getAdSense');
    Route::post('/admin/adSense', 'AdminAdSenseController@postAdSense');
    Route::get('/admin/adSense/delete/{id}', 'AdminAdSenseController@getDeleteAdSense');
    Route::get('/admin/adSense/publish/{id}', 'AdminAdSenseController@getPublishAdSense');
});
