<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Middleware\Admin;
use App\News;
use App\Repositories\AdminRepository;
use App\Repositories\NewRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\User;
use App\UserDetail;
use App\Notification;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\File;
use View;

use App\Http\Requests;

class HomeController extends Controller
{
    protected $new_repository;
    protected $post_repository;
    protected $admin_repository;
    protected $user_repository;

    public function __construct(NewRepository $newRepository, PostRepository $postRepository, AdminRepository $adminRepository, UserRepository $userRepository)
    {
        $this->new_repository = $newRepository;
        $this->post_repository = $postRepository;
        $this->admin_repository = $adminRepository;
        $this->user_repository = $userRepository;
    }

    public function getHome()
    {
        //$main_news = $this->new_repository->getMainNews();
        $slider_news = $this->new_repository->getSliderNews();
        //$last_news = $this->new_repository->getLastNews(12);
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews(12);
        $columnists = $this->admin_repository->getColumnists();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        $json_toArray = json_decode($focus_categories, true);
        $array_ids = array_column($json_toArray, 'id');
        $focuses = $this->new_repository->getFocuses(1, $array_ids);
        //$unreadNotifications = null;

        return view('home', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            //'main_news' => $main_news,
            'slider_news' => $slider_news,
            //'unreadNotifications' => $unreadNotifications,
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
            'columnists' => $columnists,
            'focuses' => $focuses
        ]);
    }

    public function getGoogleSiteConfirm(){
        return File::get(public_path() . '/google18945143611ffadd.html');
    }

    public function getMyProfile(Request $request){
        $columnists = $this->admin_repository->getColumnists();
        $user = $request->user();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('myprofile', [
            'user' => $user,
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists
        ]);

    }

    public function getUserProfile($id){
        $columnists = $this->admin_repository->getColumnists();
        $user = User::find($id);

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('myprofile', [
            'user' => $user,
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists
        ]);
    }

    public function postProfile(Request $request){
        if($request->ajax()){

            $user = Auth::user();
            if(UserDetail::where('user_id', $user->id)->exists()){
                $user_details =$user->userDetails;
            }else{
                $user_details = new UserDetail();
            }

            $user_details->user_id = $user->id;
            $user_details->biography = $request->input('biography');
            $user_details->location = $request->input('location');
            $user_details->facebook = ($request->input('facebook')=='')?null:$request->input('facebook');
            $user_details->twitter = ($request->input('twitter')=='')?null:$request->input('twitter');
            $user_details->linkedIn = ($request->input('linkedIn')=='')?null:$request->input('linkedIn');
            $user_details->googlePlus = ($request->input('googlePlus')=='')?null:$request->input('googlePlus');
            $user_details->save();

            $message = "Сіз өзіңіздің профиль мәліметтерін сәтті жаңарттыңыз!";
            $message_type = "success";

            return  response()->json([
                'message_type' => $message_type,
                'message' => $message,
                'user_detail' => $user_details]);
        }
    }

    public function getMyComments(Request $request){
        $columnists = $this->admin_repository->getColumnists();
        $comments = $this->user_repository->getComments($request->user());

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('mycomments', [
            'comments' => $comments,
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists
        ]);
    }

    public function getRoundTable($id){
        $columnists = $this->admin_repository->getColumnists();

        //$news = $this->new_repository->getCategoryNews($id);

        $slider_news = $this->new_repository->getCategoryNewsForSlider($id);
        $last_news = $this->new_repository->getLastNews(4);
        $more_readed_news = $this->new_repository->getMoreReadedNews(4);

        $focus_categories = Category::where('type', 'focus')->get();
        $json_toArray = json_decode($focus_categories, true);
        $array_ids = array_column($json_toArray, 'id');
        $focuses = $this->new_repository->getFocuses(4, $array_ids);

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('round_table', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists,
            'category' => $id,
            //'news' => $news,
            'last_news' => $last_news,
            'more_readed_news' => $more_readed_news,
            'focus_news' => $focuses,
            'slider_news' => $slider_news
        ]);
    }
    public function getFocus($id){
        $columnists = $this->admin_repository->getColumnists();

        //$news = $this->new_repository->getCategoryNews($id);

        // $slider_news = $this->new_repository->getCategoryNewsForSlider($id);
        //$last_news = $this->new_repository->getLastNews(4);
        //$more_readed_news = $this->new_repository->getMoreReadedNews(4);

        //$point_categories = Category::where('type', 'point')->get();
        //$json_toArray = json_decode($point_categories, true);
        //$array_ids = array_column($json_toArray, 'id');
        //$points = $this->new_repository->getRoundTables(4, $array_ids);

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('onfocus', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists,
            'category' => $id,
            //'news' => $news,
            //'last_news' => $last_news,
            //'more_readed_news' => $more_readed_news,
            //'point_news' => $points,
            //'slider_news' => $slider_news
        ]);
    }
    public function getContact(){
        $columnists = $this->admin_repository->getColumnists();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('contactus', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists
        ]);
    }

    public function getAbout()
    {
        $columnists = $this->admin_repository->getColumnists();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('aboutus', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'columnists' => $columnists
        ]);
    }

    public function getColumnist($id)
    {
        //$last_news = $this->new_repository->getLastNews();
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews();
        $columnist = \App\Admin::find($id);
        $columnists = $this->admin_repository->getColumnists();
        //$news = $columnist->news()->orderBy('created_at', 'desc')->paginate(18);

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('columnist', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
            'columnist' => $columnist,
            'columnists' => $columnists,
            //'news' => $news
        ]);
    }

    function currency_nbk_get_rates() {
        $url = "http://www.nationalbank.kz/rss/rates_all.xml";
        $dataObj = simplexml_load_file($url);
        $result = array();
        if ($dataObj){
            foreach ($dataObj->channel->item as $item){
                $result[] = array(
                    'title' => $item->title,
                    'pubDate' => $item->pubDate,
                    'description' => $item->description,
                    'quant' => $item->quant,
                    'index' => $item->index,
                    'change' => $item->change
                );
            }
        }

        return $result;
    }

}
