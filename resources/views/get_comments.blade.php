@foreach($comments as $comment)
    <div class="panel-body" id="comment-panel-{{$comment->id}}">
        <div class="media" style="position: relative;">
            <div class="media-image pull-left comment-author-md">
                <a href="{{ url('/profile/'.$comment->user->id) }}">
                    <img src="{{ isset($comment->user->avatar)?$comment->user->avatar:url('img/default_user.png')  }}" alt="Қолданушы суреті">
                    <div class="author-info">
                        <strong>{{ $comment->user->name }}</strong>
                        <br>
                        {{ $comment->created_at->format('F j, Y') }}
                    </div>
                </a>
            </div>
            <div class="comment-author-xs">
                <div class="author-info">
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="m-l-xs">{{ $comment->created_at->format('M j, Y') }}</span>
                </div>
            </div>
            <div class="media-body">
                <p>{{ $comment->text }}</p>
                <div class="pull-right comment-actions" >
                    <a class="text-muted" role="button" onclick="view_replies('{{$comment->id}}', this)">
                        <span class="m-l-md">
                            <span>View replies</span>
                        </span>
                    </a>
                    <a class="text-muted" role="button" onclick="reply_comment('{{$comment->id}}', '{{$comment->user->id}}', '{{$comment->user->name}}')">
                        <span id="reply" class="m-l-md">
                            <i role="button" class="fa fa-reply fa-lg"></i>
                            <span id="reply_count_{{$comment->id}}">{{ $comment->replies_count() }}</span>
                        </span>
                    </a>
                    <a id="like_comment_{{$comment->id}}" class="@if(Auth::user() && $comment->userIsLikedComment(Auth::user()->id))liked @else disliked @endif" role="button" onclick="like_comment('{{$comment->id}}')">
                        <span class="m-l-md">
                            <i role="button" class="fa fa-thumbs-o-up fa-lg"></i>
                            <span id="comment_likes_{{$comment->id}}">{{ $comment->likes_count() }}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div id="comment-replies-panel-{{$comment->id}}"></div>
    </div>
@endforeach
@if(count($comments)>1 && $comments->hasMorePages())
    <div class="pagination next-comments" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $comments->nextPageUrl() }}">Load more...</a>
    </div>
@endif