@foreach($comments as $comment)
    <div class="panel-body">
        <div class="media" style="position: relative;">
            <div class="media-image pull-left">
                <a href="{{ url('/profile/'.$comment->user->id) }}">
                    <img src="{{ isset($comment->user->avatar)?$comment->user->avatar:url('img/default_user.png')  }}" alt="Қолданушы суреті">
                    <div class="author-info">
                        <strong>{{ $comment->user->name }}</strong>
                        <br>
                        {{ $comment->created_at->format('F j, Y H:i') }}
                    </div>
                </a>
            </div>
            <div class="media-body">
                <p>{{ $comment->text }}</p>
                <div class="pull-right comment-actions" >
                    <a class="text-muted" role="button" onclick="view_replies('{{$comment->id}}')">
                                                <span class="m-l-md">
                                                    <span>View last 10 replies</span>
                                                </span>
                    </a>
                    <a class="text-muted" role="button" onclick="reply_comment('{{$comment->id}}', '{{$comment->user->id}}', '{{$comment->user->name}}')">
                                                <span id="reply" class="m-l-md">
                                                    <i role="button" class="fa fa-reply fa-lg"></i>
                                                    <span id="reply_count">{{ $comment->replies_count() }}</span>
                                                </span>
                    </a>
                    <a id="like_comment_{{$comment->id}}" class="@if($comment->userIsLikedComment(Auth::user()->id))liked @else disliked @endif" role="button" onclick="like_comment('{{$comment->id}}')">
                                                <span class="m-l-md">
                                                    <i role="button" class="fa fa-thumbs-o-up fa-lg"></i>
                                                    <span id="comment_likes_{{$comment->id}}">{{ $comment->likes_count() }}</span>
                                                </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{ $comments->links() }}