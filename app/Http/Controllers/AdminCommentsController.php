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
