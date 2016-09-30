<?php

namespace App\Http\Controllers;

use App\CommentLikes;
use App\CommentReplies;
use App\User;
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

            //Comment Replyed Notification
            $repliedComment = Comment::find($request->input('replied_id'));
            $receivedUser = $repliedComment->user;
            $sendUser = $request->user();

            $receivedUser->newNotification()
                ->withType('ReplyComment')
                ->withSubject('Your comment is replied.')
                ->withBody($sendUser->name.' replied your comment.')
                ->regarding($comment)
                ->deliver();

            $comment_reply->save();
        }

        return response()->json([
            'message' => "Сіздің пікіріңіз қабылданды!",
            'id' => $comment->id,
            //'comment' => $comment,
            //'reply' => $comment->reply,
            //'created_at' => $comment->created_at->format('F j, Y H:i'),
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

            //Your comment liked notification
            $receivedUser = $comment->user;
            $sendUser = Auth::user();

            $receivedUser->newNotification()
                ->withType('LikeComment')
                ->withSubject('Your comment is liked.')
                ->withBody($sendUser->name.' liked your comment.')
                ->regarding($comment)
                ->deliver();

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
