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

            // Notify user about your post is deleted
            $receivedUser = $post->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('PostDeleted')
                ->withSubject('Your post is deleted.')
                ->withBody($sendUser->name.' admin is deleted your post, because you don\'t save privacy.')
                ->regarding($post)
                ->deliver();

            $post->delete();

            return "Жолдама сәтті өшірілді!";
        }
    }

    public function getAccept(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            
            //Notify user about your post is accepted
            $receivedUser = $post->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('PostAccepted')
                ->withSubject('Your post is accepted.')
                ->withBody($sendUser->name.' is accepted your post, and you can see on my posts section.')
                ->regarding($post)
                ->deliver();

            $post->status = 'accepted';
            $post->save();

            return "Жолдама қабылданды!";
        }
    }

    public function getBan(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            
            //Notify user about your post is baned
            $receivedUser = $post->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('PostAccepted')
                ->withSubject('Your post is baned.')
                ->withBody($sendUser->name.' is baned your post, because this information is lie.')
                ->regarding($post)
                ->deliver();

            $post->status = 'baned';
            $post->save();

            return "Жолдама қабылданбады!";
        }
    }

    public function getProcessing(Request $request, $id){
        if($request->ajax()){
            $post = Post::find($id);
            
            //Notify user about your post is in processing
            $receivedUser = $post->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('PostProcessed')
                ->withSubject('Your post is in processing.')
                ->withBody('Your post is in processing. Please, wait.')
                ->regarding($post)
                ->deliver();

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
