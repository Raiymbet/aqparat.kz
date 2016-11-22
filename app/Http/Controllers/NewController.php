<?php

namespace App\Http\Controllers;

use App\CommentReplies;
use App\Category;
use App\Comment;
use App\Like;
use App\News;
use App\Repositories\AdminRepository;
use App\Repositories\NewRepository;
use App\Repositories\PostRepository;
use App\NewSearch\NewSearch;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use View;

class NewController extends Controller
{
    protected $new_repository;
    protected $post_repository;
    protected $admin_repository;

    public function __construct(NewRepository $newRepository, PostRepository $postRepository, AdminRepository $adminRepository)
    {
        $this->admin_repository = $adminRepository;
        $this->new_repository = $newRepository;
        $this->post_repository = $postRepository;
    }

    public function getReadNew(Request $request, $id)
    {

        $new = News::find($id);
        $new->views = $new->views+1;
        $new->save();

        $translates = $new->translates;
        $columnists = $this->admin_repository->getColumnists();
        //$last_news = $this->new_repository->getLastNews();
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews();
        $recommend_news = $this->new_repository->getRecommendNews($new);
        //$comments = $new->comments_without_replies()->simplePaginate(12);
        
        //dd($comments->userIsLikedComment(Auth::user()->id));

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('newsread', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'new' => $new,
            'translates' => $translates,
            //'comments' => $comments,
            'columnists' => $columnists,
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
            'recommend_news' => $recommend_news,
        ]);
    }

    public function getComment($type, $id){
        //id, user_id, user_avatar, user_name, created_at, comment_text, comment_replies_count, user_idLikedComment, likes_count
        if($type == 'reply') {
            $comment = CommentReplies::where('replied_id', '=', $id)->first();
            //dd($comment);
            return View::make('get_replies')->with(['replies' => [$comment]]);
        }
        else{
            $comment = Comment::find($id);
            return View::make('get_comments')->with(['comments' => [$comment]]);
        }
    }

    public function getComments(Request $request, $id){
        $new = News::find($id);
        $comments = $new->comments_without_replies()->simplePaginate(3);
        //dd($comments);
        return View::make('get_comments')->with(['comments' => $comments]);
    }

    public function getReplies(Request $request, $id){
        $comment = Comment::find($id);
        $replies = $comment->replies()->simplePaginate(3);
        //dd($replies);
        return View::make('get_replies')->with(['replies' => $replies]);
    }

    public function getNewsPaginate(Request $request, $type){
        //$news_per_page = Input::get('per_pg', 9);
        //dd($request);
        $screen = $request->input('screen');
        $columnist_id = $request->input('columnist');
        $category_id = $request->input('category');
        $view = null;
        if($type == 'main_news'){
            $news = $this->new_repository->getMainNews();
            $view = View::make('get_mainnews')->with(['main_news' => $news, 'screen' => $screen]);
        }else if($type == 'last_news'){
            $news = $this->new_repository->getLastNews(12);
            $view = View::make('get_sorted_news')->with(['news' => $news, 'screen' => $screen]);
        }else if($type == 'popular_news'){
            $news = $this->new_repository->getMoreReadedNews(12);
            $view = View::make('get_sorted_news')->with(['news' => $news, 'screen' => $screen]);
        }else if($type == 'posted_news'){
            $news = $this->post_repository->getLastPosts(12);
            $view = View::make('get_posted_news')->with(['news' => $news, 'screen' => $screen]);
        }else if($type == 'columnist_news'){
            $news = $this->new_repository->getColumnistNews($columnist_id, 12);
            $view = View::make('get_mainnews')->with(['main_news' => $news, 'screen' => $screen]);
        }else if($type == 'category_news'){
            $news = $this->new_repository->getCategoryNews($category_id, 12);
            $view = View::make('get_category_news')->with(['news' => $news]);
        }else if($type == 'round_table'){
            $news = $this->new_repository->getCategoryNews($category_id, 12);
            $view = View::make('get_roundtable_news')->with(['news' => $news]);
        }else if($type == 'focus'){
            $news = $this->new_repository->getCategoryNews($category_id, 12);
            $view = View::make('get_focus')->with(['news' => $news]);
        }

        return $view;
    }

    public function getPrint($id){
        $new = News::find($id);
        return view('print', [
            'new' => $new
        ]);
    }

    public function getCategoryNews($id)
    {
        $columnists = $this->admin_repository->getColumnists();
        //$last_news = $this->new_repository->getLastNews();
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews();
        //$news = $this->new_repository->getCategoryNews($id);
        $slider_news = $this->new_repository->getCategoryNewsForSlider($id);

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        $array_news = array();
        foreach(Category::ofExceptCategory('simple', $id)->get() as $category){
            array_push($array_news,$category->latestNewsPerCategory()->get());
        }
        //dd($array_news);

        //dd(Category::ofExceptCategory('simple', $id)->first()->latestNewsPerCategory()->get());

        return view('categorynews', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'slider_news' => $slider_news,
            'category' => Category::find($id),
            'columnists' => $columnists,
            //'news' => $news,
            'latestNewsPerCategory' => $array_news
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
        ]);
    }

    public function getSearch(Request $request)
    {
        if($request->has('Text')){
            //$searchNews = NewSearch::apply($request)->paginate(6);
            //$view = View::make('get_search_news')->with(['searchNews' => $searchNews]);
        }

        $columnists = $this->admin_repository->getColumnists();
        //$last_news = $this->new_repository->getLastNews();
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews();
        //$recommend_news = $this->new_repository->getRecommendedNews();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();

        return view('search', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            //'searchNewsView' => $view,
            'columnists' => $columnists,
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
            //'recommend_news' => $recommend_news,
        ]);
    }

    public function postSearch(Request $request)
    {
        $searchNews = NewSearch::apply($request)->paginate(6);
        return View::make('get_search_news')->with(['searchNews' => $searchNews]);
    }

    public function getTranslate($id)
    {
        $new = News::find($id);
        return $new;
    }

    public function isLikedByMe($id)
    {
        $new = News::findOrFail($id);
        if (Like::where('user_id', '=', Auth::id())->where('news_id', '=', $new->id)->exists()){
            return 'true';
        }
        else{
            return 'false';
        }
    }

    public function like(Request $request, News $new)
    {
        $existing_like = Like::withTrashed()->where('news_id', $new->id)->where('user_id', Auth::id())->first();
        if (is_null($existing_like)) {
            $like = new Like();
            $like->news_id = $new->id;
            $like->user_id = Auth::id();

            //If news is posted by user, then notify user liked post
            $receivedUser = $new->posts()->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('NewsLiked')
                ->withSubject('Your posted new is liked.')
                ->withBody($sendUser->name.' is liked your posted new.')
                ->regarding($new)
                ->deliver();

            $like->save();

            $new->likes = $new->likes+1;
            $new->save();

            return response()->json(['like' => 'liked', 'likes' => $new->likes]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();

                $new->likes = $new->likes-1;
                $new->save();

                return response()->json(['like' => 'disliked', 'likes' => $new->likes]);
            } else {
                $existing_like->restore();

                $new->likes = $new->likes+1;
                $new->save();

                return response()->json(['like' => 'liked', 'likes' => $new->likes]);
            }
        }
    }
    
}
