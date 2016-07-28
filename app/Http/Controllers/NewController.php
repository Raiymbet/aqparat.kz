<?php

namespace App\Http\Controllers;

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
        $new = News::findOrFail($id)->first();
        if (Like::whereUserId(Auth::id())->whereNewId($new->id)->exists()){
            return 'true';
        }
        return 'false';
    }

    public function like(News $new)
    {
        $existing_like = Like::withTrashed()->whereNewId($new->id)->whereUserId(Auth::id())->first();

        if (is_null($existing_like)) {
            Like::create([
                'new_id' => $new->id,
                'user_id' => Auth::id()
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }
    
}
