<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\AdminRepository;
use App\Repositories\PostRepository;
use App\Repositories\NewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Post;
use App\User;

class PostController extends Controller
{
    protected $post_repository;
    protected $admin_repository;
    protected $new_repository;

    public function __construct(NewRepository $newRepository,PostRepository $postRepository, AdminRepository $adminRepository)
    {
        $this->middleware('auth');
        $this->post_repository = $postRepository;
        $this->admin_repository = $adminRepository;
        $this->new_repository = $newRepository;
    }

    /**
     * Отображение списка всех posts пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getMyPosts(Request $request)
    {
        $columnists = $this->admin_repository->getColumnists();
        $posts = $this->post_repository->getPosts($request->user());
        //$last_news = $this->new_repository->getLastNews();
        //$last_posts = $this->post_repository->getLastPosts();
        //$more_readed_news = $this->new_repository->getMoreReadedNews();
        $recommend_news = $this->new_repository->getRecommendedNews();

        $simple_categories = Category::ofType('simple')->get();
        $round_table_categories = Category::ofType('point')->get();
        $focus_categories = Category::ofType('focus')->get();
        
        return view('myposts', [
            'categories' => $simple_categories,
            'round_tables' => $round_table_categories,
            'onfocus' => $focus_categories,
            'posts' => $posts,
            'columnists' => $columnists,
            //'last_news' => $last_news,
            //'last_posts' => $last_posts,
            //'more_readed_news' => $more_readed_news,
            'recommend_news' => $recommend_news,
        ]);
    }
    
    /**
     * Создание новой post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:2000',
        ]);

        $request->user()->posts()->create([
            'text' => $request->text,
        ]);
        return "Хабарлама сәтті жолданды!";
    }

    /**
     * Уничтожить заданную post.
     *
     * @param  Request  $request
     * @param  string  $post_id
     * @return Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return redirect('/myposts');
    }

    public function edit(Request $request){
        $id = $request->input('post_id');
        $text = $request->input('text');

        $post = Post::find($id);
        if(strcmp($post->text, $text) == 0){
            return ['message' => "Post text is not changed!", 'text' => $post->text];
        }
        $post->text = $text;
        $post->save();

        return ['message' => "Post is changed!", 'text' => $post->text];
    }
    //public function search(Request $request)
    //{

    //}
}
