@foreach($replies as $reply)
    <div class="forum-comments" id="comment-panel-{{ $reply->comment->id }}">
        <div class="media" style="position: relative;">
            <div class="media-image pull-left comment-author-md">
                <a href="{{ url('/profile/'.$reply->comment->user->id) }}">
                    <img src="{{ isset($reply->comment->user->avatar)?$reply->comment->user->avatar:url('img/default_user.png')  }}" alt="profile-picture">
                    <div class="author-info">
                        <strong>{{ $reply->comment->user->name }}</strong>
                        <br>
                        {{ $reply->comment->created_at->format('F j, Y') }}
                    </div>
                </a>
            </div>
            <div class="comment-author-xs">
                <div class="author-info">
                    <span><strong>{{$reply->comment->user->name}}</strong></span>
                    <span class="text-muted">{{$reply->comment->created_at->format('F j, Y')}}</span>
                </div>
            </div>
            <div class="media-body">
                <p>{{$reply->comment->text}}</p>
                <div class="pull-right comment-actions" >
                    <a class="text-muted" role="button" onclick="view_replies('{{$reply->comment->id}}', this)">
                            <span class="m-l-md">
                                <span>View replies</span>
                            </span>
                    </a>
                    <a class="text-muted" role="button" onclick="reply_comment('{{$reply->comment->id}}', '{{$reply->comment->user->id}}', '{{$reply->comment->user->name}}')">
                            <span id="reply" class="m-l-md">
                                <i role="button" class="fa fa-reply fa-lg"></i>
                                <span id="reply_count_{{$reply->comment->id}}">{{ $reply->comment->replies_count() }}</span>
                            </span>
                    </a>
                    <a id="like_comment_{{$reply->comment->id}}" class="@if(!Auth::guest() && $reply->comment->userIsLikedComment(Auth::user()->id))liked @else disliked @endif" role="button" onclick="like_comment('{{$reply->comment->id}}')">
                            <span class="m-l-md">
                                <i role="button" class="fa fa-thumbs-o-up fa-lg"></i>
                                <span id="comment_likes_{{$reply->comment->id}}">{{ $reply->comment->likes_count() }}</span>
                            </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if(count($replies)>1 && $replies->hasMorePages())
    <div class="pagination next-reply" style="clear: both; display: flex;">
        <a class="btn btn-default center-block" href="{{ $replies->nextPageUrl() }}">More replies...</a>
    </div>
@endif