@extends('layouts.home')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flag-icon.css') }}">
@endsection

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">{{ $new->category->name }}</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="hpanel blog-article-box">
                        <div class="panel-body" style="padding-top: 10px;">
                            <div class="row no-margin">
                                <div class="media" style="padding-bottom: 20px; border-bottom: 1px solid #e4e5e7">
                                    <div class="media-image pull-left news-author-avatar">
                                        <a href="{{ url('/profile/'.$new->author->id) }}">
                                            <img class="img-responsive" width="100" height="100" src="{{ URL::asset($new->author->avatar) }}" alt="User Profile">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h5 class="no-margin">
                                                <a href="{{ url('/profile/'.$new->author->id) }}">
                                                    <strong class="text-uppercase">{{ $new->author->name }}</strong>
                                                </a>
                                            </h5>
                                            <small class="m-t-sm" style="font-size: 11px"><a href="#">{{ $new->author->email }}</a></small>
                                        </div>
                                        <small style="font-size: 11.5px">
                                            @if(!is_null($new->author->adminDetails))
                                                {!! str_limit(strip_tags($new->author->adminDetails->about), 300) !!}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <div class="pull-left">
                                    {{ $new->created_at->format('d.m.y H:i') }}
                                </div>
                                <a href="{{ url('/print/'.$new->id) }}" id="print" class="btn btn-default pull-right">
                                    <i class="fa fa-print fa-lg"></i>
                                </a>

                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="selected-language">
                                        <i class="flag-icon flag-icon-kz"></i>
                                        <span>Kazakh</span>
                                    </span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" id="language-dropdown">
                                        @if(count($translates)>0)
                                            <li>
                                                <button type="button" class="btn btn-default btn-block" onclick="getTranslate('{{$new->id}}', '{{$new->language}}')">
                                            <span id="language-kz">
                                                <i class="flag-icon flag-icon-kz"></i>
                                                <span>Kazakh</span>
                                            </span>
                                                </button>
                                            </li>
                                        @endif
                                        @foreach($translates as $translate)
                                            <li>
                                                <button type="button" class="btn btn-default btn-block" onclick="getTranslate('{{$translate->news->id}}', '{{$translate->news->language}}')">
                                                    @if($translate->news->language == 'ru')
                                                        <span id="language-ru">
                                                        <i class="flag-icon flag-icon-ru"></i>
                                                        <span>Russian</span>
                                                    </span>
                                                    @elseif($translate->news->language == 'en')
                                                        <span id="language-en">
                                                        <i class="flag-icon flag-icon-gb"></i>
                                                        <span>English</span>
                                                    </span>
                                                    @endif
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <h3 id="new_title"><strong>{{ $new->title }}</strong></h3>

                            <br>
                            <br>
                            {!! SocShare::renderJs() !!}
                            <span class="st_facebook_hcount" displaytext="Facebook" st_processed="yes">
                            <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                <span>
                                    <a onclick="{{ SocShare::facebook([
                                        'type' => 'share',
                                        'redirect_uri' => 'http://aqparat.kz',
                                        'display'      => 'popup',
                                        //'from'         => '',
                                        //'to'           => '',
                                        'picture'      => 'http://aqparat.kz/news/25.07.2016/Tank.jpg',
                                        //'source'       => '',
                                        'name'         => 'Aqparat.kz',
                                        'caption'      => '',
                                        'description'  => str_limit(strip_tags($new->text), 200),
                                        //'properties'   => array(), // ['some' => ['text' => 'text', 'href' => 'href']]
                                        //'actions'      => array(), // ['name' => 'name', 'link' => 'link']
                                        //'ref'          => array(),
                                    ])->getJs() }}" href="javascript:void(0);">
                                        <span class="stMainServices st-facebook-counter" style="background-image: url(&quot;http://w.sharethis.com/images/facebook_counter.png&quot;);">&nbsp;</span>
                                        <span class="stArrow">
                                            <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                <span class="stBubble_hcount">{{ SocShare::facebook()->getCount() }}</span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </span>
                        </span>

                        <span class="st_twitter_hcount" displaytext="Tweet" st_processed="yes">
                            <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                <span>
                                    <a onclick="{{ SocShare::twitter([
                                        'hashtags' => array('aqparat.kz', $new->category->name),
                                        'text' => $new->title
                                    ])->getJs() }}" href="javascript:void(0);">
                                        <span class="stMainServices st-twitter-counter" style="background-image: url(&quot;http://w.sharethis.com/images/twitter_counter.png&quot;);">&nbsp;</span>
                                        <span class="stArrow">
                                            <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                <span class="stBubble_hcount">{{ SocShare::twitter([
                                                        'hashtags' => array('aqparat.kz', $new->category->name),
                                                        'text' => $new->title
                                                    ])->getCount() }}
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </span>
                        </span>

                        <span class="st_googleplus_hcount" displaytext="Google +" st_processed="yes">
                            <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                <span>
                                    <a onclick="{{ SocShare::gplus([
                                        'hl' => 'ru'
                                    ])->getJs() }}" href="javascript:void(0);">
                                        <span class="stButton_gradient">
                                            <span class="chicklets googleplus">Google +</span>
                                        </span>
                                        <span class="stArrow">
                                            <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                <span class="stBubble_hcount">{{ SocShare::gplus([
                                                        'hl' => 'ru'
                                                    ])->getCount() }}
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </span>
                        </span>

                        <span class="st_vkontakte_hcount" displaytext="Vkontakte" st_processed="yes">
                            <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                <span>
                                    <a onclick="{{ SocShare::vk([
                                        'title' => $new->title,
                                        'description' => str_limit(strip_tags($new->text), 200),
                                        'image' => ''.URL::asset($new->avatar_picture),
                                        'noparse' => false,
                                    ])->getJs() }}" href="javascript:void(0);">
                                        <span class="stButton_gradient">
                                            <span class="chicklets vkontakte">Vkontakte</span>
                                        </span>
                                        <span class="stArrow">
                                            <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                <span class="stBubble_hcount">{{ SocShare::vk([
                                                        'title' => $new->title,
                                                        'description' => str_limit(strip_tags($new->text), 200),
                                                        'image' => ''.URL::asset($new->avatar_picture),
                                                        'noparse' => false,
                                                    ])->getCount() }}
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </span>
                        </span>
                            <br>
                            <br>

                            <div id="new_text_content">
                                <br>
                                @if(!is_null($new->avatar_picture))
                                    <img class="img-responsive image-new-avatar-picture" src="{{ URL::asset($new->avatar_picture) }}" alt="News">
                                @endif
                                <div id="new_text">{!! $new->text !!}</div>
                                <br>
                            <span class="st_facebook_hcount" displaytext="Facebook" st_processed="yes">
                            <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                <span>
                                    <a onclick="{{ SocShare::facebook([
                                        'type' => 'share',
                                        'redirect_uri' => 'http://aqparat.kz',
                                        'display'      => 'popup',
                                        //'from'         => '',
                                        //'to'           => '',
                                        'picture'      => 'http://aqparat.kz/news/25.07.2016/Tank.jpg',
                                        //'source'       => '',
                                        'name'         => 'Aqparat.kz',
                                        'caption'      => '',
                                        'description'  => str_limit(strip_tags($new->text), 200),
                                        //'properties'   => array(), // ['some' => ['text' => 'text', 'href' => 'href']]
                                        //'actions'      => array(), // ['name' => 'name', 'link' => 'link']
                                        //'ref'          => array(),
                                    ])->getJs() }}" href="javascript:void(0);">
                                        <span class="stMainServices st-facebook-counter" style="background-image: url(&quot;http://w.sharethis.com/images/facebook_counter.png&quot;);">&nbsp;</span>
                                        <span class="stArrow">
                                            <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                <span class="stBubble_hcount">{{ SocShare::facebook()->getCount() }}</span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </span>
                        </span>

                            <span class="st_twitter_hcount" displaytext="Tweet" st_processed="yes">
                                <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                    <span>
                                        <a onclick="{{ SocShare::twitter([
                                            'hashtags' => array('aqparat.kz', $new->category->name),
                                            'text' => $new->title
                                        ])->getJs() }}" href="javascript:void(0);">
                                            <span class="stMainServices st-twitter-counter" style="background-image: url(&quot;http://w.sharethis.com/images/twitter_counter.png&quot;);">&nbsp;</span>
                                            <span class="stArrow">
                                                <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                    <span class="stBubble_hcount">{{ SocShare::twitter([
                                                            'hashtags' => array('aqparat.kz', $new->category->name),
                                                            'text' => $new->title
                                                        ])->getCount() }}
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </span>
                                </span>
                            </span>

                            <span class="st_googleplus_hcount" displaytext="Google +" st_processed="yes">
                                <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                    <span>
                                        <a onclick="{{ SocShare::gplus([
                                            'hl' => 'ru'
                                        ])->getJs() }}" href="javascript:void(0);">
                                            <span class="stButton_gradient">
                                                <span class="chicklets googleplus">Google +</span>
                                            </span>
                                            <span class="stArrow">
                                                <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                    <span class="stBubble_hcount">{{ SocShare::gplus([
                                                            'hl' => 'ru'
                                                        ])->getCount() }}
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </span>
                                </span>
                            </span>

                            <span class="st_vkontakte_hcount" displaytext="Vkontakte" st_processed="yes">
                                <span style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
                                    <span>
                                        <a onclick="{{ SocShare::vk([
                                            'title' => $new->title,
                                            'description' => str_limit(strip_tags($new->text), 200),
                                            'image' => ''.URL::asset($new->avatar_picture),
                                            'noparse' => false,
                                        ])->getJs() }}" href="javascript:void(0);">
                                            <span class="stButton_gradient">
                                                <span class="chicklets vkontakte">Vkontakte</span>
                                            </span>
                                            <span class="stArrow">
                                                <span class="stButton_gradient stHBubble" style="display: inline-block;">
                                                    <span class="stBubble_hcount">{{ SocShare::vk([
                                                            'title' => $new->title,
                                                            'description' => str_limit(strip_tags($new->text), 200),
                                                            'image' => ''.URL::asset($new->avatar_picture),
                                                            'noparse' => false,
                                                        ])->getCount() }}
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </span>
                                </span>
                            </span>
                            </div>
                        </div>
                        <div class="panel-body panel-statistics text-muted">
                            <div class="row no-margin">
                                <div class="pull-right">
                                    <span><i class="fa fa-eye fa-lg"></i> {{ $new->views }}</span>
                                    <a href="#comments" class="text-muted">
                                    <span class="margin-left-20">
                                        <i class="fa fa-comment fa-lg"></i> {{ $new->comments_count() }}
                                    </span>
                                    </a>
                                    <a id="like" class="disliked" role="button" onclick="like()">
                                    <span class="margin-left-20">
                                        <i role="button" class="fa fa-thumbs-o-up fa-lg"></i>
                                        <span id="new_likes">{{ $new->likes }}</span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hpanel forum-box">
                        <div class="panel-heading hbuilt">
                            <h6>Пікірлер (<span id="comments-count">{{ $new->comments_count() }}</span>) </h6>
                        </div>
                        <div id="comments">
                            @foreach($comments as $comment)
                                <div class="panel-body">
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
                                                <a class="text-muted" role="button" onclick="view_replies('{{$comment->id}}')">
                                                <span class="m-l-md">
                                                    <span>Last 10 replies</span>
                                                </span>
                                                </a>
                                                <a class="text-muted" role="button" onclick="reply_comment('{{$comment->id}}', '{{$comment->user->id}}', '{{$comment->user->name}}')">
                                                <span id="reply" class="m-l-md">
                                                    <i role="button" class="fa fa-reply fa-lg"></i>
                                                    <span id="reply_count">{{ $comment->replies_count() }}</span>
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
                                    @if($comment->replies_count()>0)
                                        @foreach($comment->replies as $reply)
                                            <div class="forum-comments" id="">
                                                <div class="media" style="position: relative;">
                                                    <div class="media-image pull-left comment-author-md">
                                                        <a href="{{ url('/profile/'.$reply->comment->user->id) }}">
                                                            <img src="{{ isset($reply->comment->user->avatar)?$reply->comment->user->avatar:url('img/default_user.png')  }}" alt="profile-picture">
                                                            <div class="author-info">
                                                                <strong>{{ $comment->user->name }}</strong>
                                                                <br>
                                                                {{ $comment->created_at->format('F j, Y') }}
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
                                                            <a class="text-muted" role="button" onclick="view_replies('{{$reply->comment->id}}')">
                                                            <span class="m-l-md">
                                                                <span>Last 10 replies</span>
                                                            </span>
                                                            </a>
                                                            <a class="text-muted" role="button" onclick="reply_comment('{{$reply->comment->id}}', '{{$reply->comment->user->id}}', '{{$reply->comment->user->name}}')">
                                                            <span id="reply" class="m-l-md">
                                                                <i role="button" class="fa fa-reply fa-lg"></i>
                                                                <span id="reply_count">{{ $reply->comment->replies_count() }}</span>
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
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-default center-block" onclick="load_more_comments()">Load more...</button>
                        </div>
                    </div>

                    <div class="hpanel">
                        <div class="panel-heading hbuilt">
                            <h6>Пікір жазу</h6>
                        </div>
                        <div class="panel-body">
                            <div class="row-with-padding" style="">
                                <form id="comment_form" class="form-horizontal">
                                    <div class="form-group">
                                        <textarea class="form-control textarea-infocus" id="comment-textarea" placeholder="Пікіріңізді осында жазыңыз..." rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <p id="comment-result" class="text-info">Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз</p>
                                            </div>
                                            <button type="submit" class="btn btn-info pull-right">
                                                Жіберу
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="hpanel hblue">
                        <div class="panel-heading hbuilt">
                            <h6>Оқуға ұсынамыз</h6>
                        </div>
                        <div class="panel-body hblue">
                            <div class="row row-with-margin">
                                @foreach($recommend_news as $index => $recommend_new)
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail text-justify pull-left">
                                        <a href="{{ url('/newsread/'.$recommend_new->id) }}">
                                            <img class="img-responsive image-main-news" src="{{ asset($recommend_new->avatar_picture) }}">
                                            <h5 class="{{ $colors[$index%4] }}">{{ $recommend_new->category->name }}</h5>
                                            <h5>{{ $recommend_new->title }}</h5>
                                            <p class="news-datetime">{{ $recommend_new->created_at->format('F j, H:i') }}</p>
                                            <div class="small statistics-style">
                                                <span><i class="fa fa-eye"></i>{{ $recommend_new->views }}</span>
                                                <span><i class="fa fa-comment"></i>{{ $recommend_new->comments_count() }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div id="jarnama" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="hpanel hred">
                        <div class="panel-heading hbuilt">
                            <h6 class="text-center">Жарнама</h6>
                        </div>
                        <div class="panel-body">
                            <p>Ақпараттандыру сайты туралы жарнамалар салуға болады</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        var reply = 0, replied_id = null;
        $(document).ready(function () {

        });

        @if(!Auth::guest())
            $.get('{{ url('/newsread/'.$new->id.'/islikedbyme') }}', function (data) {
            //console.log(data);
            if(data=='true'){
                $('#like').removeClass('disliked').addClass('liked');
            }
        });
        @endif

        function like(){
            @if(Auth::guest())
                window.location.replace('{{url('/login')}}');
            @else
                $.post("{{ url('/like/'.$new->id) }}").done( function (data) {
                //console.log(data);
                if(data.like=='liked'){
                    if($('#like').hasClass('disliked')){
                        $('#like').removeClass('disliked').addClass('liked');
                    }
                }else{
                    if($('#like').hasClass('liked')){
                        $('#like').removeClass('liked').addClass('disliked');
                    }
                }
                $('#new_likes').html(data.likes);
            });
            @endif
        }

        function like_comment(id_comment){
            @if(Auth::guest())
                window.location.replace('{{url('/login')}}');
            @else
                $.post("{{ url('/comment/like/') }}"+'/'+id_comment).done( function (data) {
                console.log(data);
                if(data.like=='liked'){
                    $('#like_comment_'+id_comment).removeClass().addClass('liked');
                }else{
                    $('#like_comment_'+id_comment).removeClass().addClass('disliked');
                }
                $('#comment_likes_'+id_comment).html(data.likes);
            });
            @endif
        }

        function reply_comment(comment_id, user_id, user_name){
            //reply comment
            //console.log('Comment: '+comment_id+"; User: "+user_id+'; Name: '+user_name);
            reply = 1;
            replied_id = comment_id;
            console.log('Reply: '+reply+"; Replied_id: "+replied_id);
            $('#comment-textarea').val(user_name+', ').focus();
        }

        function view_replies(comment_id){
            //get comment replies and show function
            console.log('View replies: '+comment_id);
        }

        function load_more_comments() {
            $.ajax({
                url : '?page=' + page,
                dataType: 'json',
            }).done(function (data) {
                $('.posts').html(data);
                location.hash = page;
            }).fail(function () {
                alert('Posts could not be loaded.');
            });
        }

        function getTranslate(id, language){
            $.get('{{ url('/newsread/translate') }}'+'/'+id, function(data) {
                //console.log(data);
                $('#new_title').html(data.title);
                $('#new_text').html(data.text);
                var selected_content = $('#language-'+language).html();
                $('#selected-language').html(selected_content);
                $('#print').attr('href', '{{url('/print')}}'+'/'+id);
            });
        }

        //$('#select_translate').change( function () {
            //console.log($(this).val());
        //});

        $('#comment_form').submit( function (event) {
            event.preventDefault();

            $comment = $('#comment-textarea').val();
            if($comment){
                @if(Auth::guest()){
                    window.location.replace('{{url('/login')}}');
                }@else
                    $.post("{{ url('/newsread/'.$new->id) }}", {
                        comment : $comment,
                        reply: reply,
                        replied_id: replied_id
                    }).done( function (response) {
                        $('#comment-textarea').val('');
                        $('#comment-result').removeClass().addClass('text-success').html(response.message);
                        //console.log(data);
                        if(response.count == 1){
                            $('#comments').append(
                                    '<div class="panel-heading hbuilt">' +
                                    '<h6>Пікірлер (<span id="comments-count">'+response.count+'</span>)</h6>'+
                                    '</div>');
                        }
                        if(reply === 1){
                            $('#comments').append(
                                    '<div class="panel-body">' +
                                    '<div class="media">' +
                                    '<div class="media-image pull-left">' +
                                    '<a href="#">' +
                                    '<img src="{{ isset(Auth::user()->avatar)?Auth::user()->avatar:url('img/default_user.png')  }}" alt="Қолданушы суреті">'+
                                    '<div class="author-info">' +
                                    '<strong>{{ Auth::user()->name }}</strong>'+
                                    '<br>' +
                                    ''+response.created_at+
                                    '</div>' +
                                    '</a>' +
                                    '</div>' +
                                    '<div class="media-body">' +
                                    '<p>'+response.comment.text+'</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>'
                            );
                        }
                        $('#comments-count').html(response.count);
                        reply = 0;
                        replied_id = null;
                    });
                @endif
            }else{
                $('#comment-result').removeClass().addClass('text-danger').html("Пікір енгізіңіз!");
            }
            //setTimeout(function() { $("#comment-result").removeClass().addClass('text-info').html('Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз'); }, 2000);
        });
    </script>
@endsection