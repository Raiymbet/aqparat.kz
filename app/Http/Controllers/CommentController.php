<?php

namespace App\Http\Controllers;

use App\CommentLikes;
use App\CommentReplies;
use Auth;
use App\Comment;
use App\Like;
use App\News;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showComments(Request $request, $id){
        $new = News::find($id);
        $comments = $new->comments_without_replies()->simplePaginate(3);
        if ($request->ajax()) {
            return Response::json(View::make('get_comments', array('comments' => $comments))->render());
        }
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
        $comment->reply = $request->input('reply');
        $comment->save();

        if($comment->reply == true){
            $comment_reply = new CommentReplies();
            $comment_reply->replied_id = $comment->id;
            $comment_reply->comment_id = $request->input('replied_id');
            $comment_reply->save();
        }

        return response()->json([
            'message' => "Сіздің пікіріңіз қабылданды!",
            'comment' => $comment,
            'reply' => $comment->reply,
            'created_at' => $comment->created_at->format('F j, Y H:i'),
            'count' => News::find($id)->comments_count(),
        ]);
    }

    public function like(Request $request, Comment $comment)
    {
        $existing_like = CommentLikes::withTrashed()->where('comment_id', $comment->id)->where('user_id', Auth::id())->first();
        if (is_null($existing_like)) {
            $like = new CommentLikes();
            $like->comment_id = $comment->id;
            $like->user_id = Auth::id();
            $like->save();

            return response()->json(['like' => 'liked', 'likes' => $comment->likes_count()]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();

                return response()->json(['like' => 'disliked', 'likes' => $comment->likes_count()]);
            } else {
                $existing_like->restore();

                return response()->json(['like' => 'liked', 'likes' => $comment->likes_count()]);
            }
        }
    }
}
