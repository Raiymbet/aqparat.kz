<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminCommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getComments()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.comments', [
            'comments' => $comments
        ]);
    }

    public function getDestroy(Request $request, $id)
    {
        if($request->ajax()){
            //$this->authorize('destroy', $post);
            $comment = Comment::find($id);
            //dd($comment->replies()->get(), $comment->commentLikes()->withTrashed()->get());
            if($comment->replies()->get()->count() > 0){
                foreach ($comment->replies()->get() as $replies){
                    //dd($replies->delete());
                    $replies->delete();
                }
            }
            //dd($comment, $comment->commentLikes()->withTrashed()->get());
            if($comment->commentLikes()->withTrashed()->get()->count() > 0){
                //dd($comment->commentLikes()->get());
                foreach ($comment->commentLikes()->withTrashed()->get() as $like){
                    //dd($likes->delete());
                    $like->forceDelete();
                }
            }
            $comment->delete();
            return "Пікір сәтті өшірілді!";
        }
    }

    public function getBan(Request $request, $id){
        if($request->ajax()){
            $comment = Comment::find($id);
            $comment->baned = true;
            $comment->save();
            return "Пікір банға тасталды!";
        }
    }
}
