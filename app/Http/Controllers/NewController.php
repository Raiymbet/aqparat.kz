<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Comment;
use App\Like;
use App\News;
use App\Repositories\AdminRepository;
use App\Repositories\NewRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

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

    public function getReadNew($id)
    {
        $new = News::find($id);
        $new->views = $new->views+1;
        $new->save();

        $translates = $new->translates;
        $columnists = $this->admin_repository->getColumnists();
        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        return view('newsread', [
            'categories' => Category::all(),
            'new' => $new,
            'translates' => $translates,
            'comments' => $new->comments,
            'columnists' => $columnists,
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
        ]);
    }

    public function getCategoryNews($id)
    {
        $columnists = $this->admin_repository->getColumnists();
        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        $news = $this->new_repository->getCategoryNews($id);
        return view('categorynews', [
            'category' => Category::find($id)->name,
            'categories' => \App\Category::all(),
            'columnists' => $columnists,
            'news' => $news,
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
        ]);
    }

    public function getSearch(Request $request)
    {
        if($request->input('search')===''){
            $searchedNews = News::where('language', 'kz')->orderBy('created_at', 'desc')->paginate(6);
        }else{
            $searchedNews = News::where('language', '=', 'kz')
                ->where('text', 'LIKE', '%'.$request->input('search').'%')
                ->orWhere('title', 'LIKE', '%'.$request->input('search').'%')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
        }

        $columnists = $this->admin_repository->getColumnists();
        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        return view('search', [
            'searchNews' => $searchedNews,
            'categories' => \App\Category::all(),
            'columnists' => $columnists,
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
        ]);
    }

    public function postSearch(Request $request)
    {
        $text = $request->input('text');
        $category = $request->input('category');
        $date = ($request->input('date')==='')?null:$request->input('date');

        if($category !== 'all' && !is_null($date)){
            $searchedNews = News::where('language', '=', 'kz')
                ->where('category_id', '=', $category)
                ->where('created_at', '=', $date)
                ->paginate(6);
        }else if($category === 'all' && !is_null($date)) {
            $searchedNews = News::where('language', '=', 'kz')
                ->where('created_at', '=', $date)
                ->paginate(6);
        }else if(is_null($date) && $category !== 'all') {
            $searchedNews = News::where('language', '=', 'kz')
                ->where('category_id', '=', $category)
                ->paginate(6);
        }else{
            $searchedNews = News::where('language', '=', 'kz')
                ->paginate(6);
        }
        return view('postsearch', [
            'searchNews' => $searchedNews,
        ]);
    }

    public function getTranslate($id)
    {
        $new = News::find($id);
        return $new;
    }

    public function postComment(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|max:2000',
        ]);

        $comment = new Comment();
        $comment->text = $request->input('comment');
        $comment->user_id = $request->user()->id;
        $comment->news_id = $id;
        $comment->save();
        return "Сіздің пікіріңіз қабылданды!";
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
