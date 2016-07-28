<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;

use App\Http\Requests;
use App\Post;
use Input;

class AdminPostsController extends Controller
{
    protected $posts;

    public function __construct(PostRepository $posts)
    {
        $this->middleware('admin');
        $this->posts = $posts;
    }

    public function getPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.posts', [
            'posts' => $posts,
        ]);
    }

    public function getDestroy(Request $request, $id)
    {
        if($request->ajax()){
            //$this->authorize('destroy', $post);
            $post = Post::find($id);
            $post->delete();
            return "Жолдама сәтті өшірілді!";
        }
    }

    public function getAccept(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            $post->status = 'accepted';
            $post->save();
            return "Жолдама қабылданды!";
        }
    }

    public function getBan(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            $post->status = 'baned';
            $post->save();
            return "Жолдама қабылданбады!";
        }
    }

    public function getProcessing(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            $post->status = 'processing';
            $post->save();
            return "Жолдама өңделу барысына өзгертілді!";
        }
    }

    public function getWriteNew($id){
        return view('admin.addnew', [
            'postId' => $id,
            'categories' => Category::all()
        ]);
    }
}
