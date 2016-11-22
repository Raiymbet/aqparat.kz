@extends('layouts.home')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flag-icon.css') }}">
    <link href="http://vjs.zencdn.net/5.11.6/video-js.css" rel="stylesheet">

    <!-- If you'd like to support IE8 -->
    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

    <title>{{ $new->title }}</title>
    <!-- Meta tags OG -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ Request::fullUrl()}}">
    <meta property="og:site_name" content="Aqparat.kz">
    <meta property="og:title" content="{{ $new->title }}">
    <meta property="og:description" content="{{ $new->short_description }}">
    <meta property="og:image" content="{{ URL::asset($new->avatar_picture) }}">
    <meta property="og:locale" content="kk_KZ">
    <meta property="article:author" content="{{ $new->author->name }}">
    <meta property="article:section" content="{{ $new->category->name }}">
    <meta property="article:tag" content="{{ $new->tags }}">

    <!-- Meta tags Twitter Cards -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ Request::fullUrl()}}">
    <meta name="twitter:title" content="{{ $new->title }}">
    <meta name="twitter:description" content="{{ $new->short_description }}">
    <meta name="twitter:image" content="{{ URL::asset($new->avatar_picture) }}">
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
                        <div class="panel-body p-t-xs">
                            <div class="row no-margin">
                                <div class="media p-b" style="border-bottom: 1px solid #e4e5e7">
                                    <div class="media-image pull-left news-author-avatar">
                                        <a href="{{ url('/profile/'.$new->author->id) }}">
                                            <img class="img-responsive" width="100" height="100" src="{{ URL::asset($new->author->avatar) }}" alt="User Profile">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h5 class="no-margin">
                                                <a href="{{ url('/columnist/'.$new->author->id) }}">
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
                                        @if(!is_null($new->posts))
                                            <br>
                                            <small>
                                                posted by <a href="#">{{$new->posts->user->name}}</a>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="pull-left">
                                    {{ $new->created_at->format('F j, Y, H:i') }}
                                </div>
                                <a href="{{ url('/print/'.$new->id) }}" id="print-btn" class="btn btn-default pull-right">
                                    <i class="fa fa-print fa-lg"></i>
                                </a>

                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if($new->language == 'kz')
                                            <span id="selected-language">
                                                <i class="flag-icon flag-icon-kz"></i>
                                                <span>Kazakh</span>
                                            </span>
                                        @elseif($new->language == 'ru')
                                            <span id="language-ru">
                                                <i class="flag-icon flag-icon-ru"></i>
                                                <span>Russian</span>
                                            </span>
                                        @elseif($new->language == 'en')
                                            <span id="language-en">
                                                <i class="flag-icon flag-icon-gb"></i>
                                                <span>English</span>
                                            </span>
                                        @endif
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

                            <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='25689180'></div>

                            <div id="new_text_content" class="m-t-sm">
                                <div class="img-avatar-container">
                                    @if(!is_null($new->video_url))
                                        <video id="my-video" class="video-js vjs-16-9 vjs-default-skin" controls preload="auto"
                                               poster="{{ URL::asset($new->avatar_picture) }}" data-setup="{}">
                                            <source src="{{ URL::asset($new->video_url) }}" type='video/mp4'>
                                            <source src="{{ URL::asset($new->video_url) }}" type='video/webm'>
                                            <p class="vjs-no-js">
                                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                            </p>
                                        </video>
                                        @if(!is_null($new->media_author))
                                            <span class="video-author">{{$new->media_author}}</span>
                                        @endif
                                    @elseif(!is_null($new->avatar_picture))
                                        <img class="img-responsive image-new-avatar-picture" src="{{ URL::asset($new->avatar_picture) }}" alt="News">
                                        @if(!is_null($new->media_author))
                                            <span class="image-author">{{$new->media_author}}</span>
                                        @endif
                                    @endif
                                </div>
                                <div id="new_text">{!! $new->text !!}</div>

                            </div>
                        </div>
                        <div class="panel-body panel-statistics text-muted">
                            <div class="row no-margin">
                                <div class="pull-right">
                                    <span><i class="fa fa-eye fa-lg"></i> {{ $new->views }}</span>
                                    <a href="#comments" class="text-muted">
                                    <span class="m-l-md">
                                        <i class="fa fa-comment fa-lg"></i> {{ $new->comments_count() }}
                                    </span>
                                    </a>
                                    <a id="like" class="disliked" role="button" onclick="like()">
                                    <span class="m-l-md">
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
                                        <textarea class="form-control textarea-infocus" id="comment-textarea" placeholder="Пікіріңізді осында жазыңыз..." rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                @if (Auth::guest())
                                                    <p class="text-danger">Please, login for send comment</p>
                                                @endif
                                                <p id="comment-result" class="text-info">Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз</p>
                                            </div>
                                            <button type="submit" class="btn btn-info pull-right m-l-xs">
                                                Жіберу
                                            </button>
                                            <button type="button" onclick="resetComment()" class="btn btn-info pull-right">Cancel</button>
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
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail pull-left">
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
    <script src="http://vjs.zencdn.net/5.11.6/video.js"></script>
    <script type="text/javascript">
        var reply = 0, replied_id = null, addedComment = false;
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
            //console.log('Reply: '+reply+"; Replied_id: "+replied_id);
            $('#comment-textarea').val(user_name+', ').focus();
        }
        
        function resetComment() {
            reply = 0;
            replied_id = null;
            $('#comment_form')[0].reset();
            console.log('Reply: '+reply+' Replied: '+replied_id);
        }

        function view_replies(comment_id, element){
            //get comment replies and show function
            //console.log('View replies: '+comment_id);
            element.remove();
            $.get("{{ url('/newsread/replies/') }}"+'/'+comment_id).done( function (data) {
                $('#comment-replies-panel-'+comment_id).html(data);
            });
        }

        function getPaginationSelectedPage(url) {
            var chunks = url.split('?');
            var baseUrl = chunks[0];
            var querystr = chunks[1].split('&');
            var pg = 1;
            for (i in querystr) {
                var qs = querystr[i].split('=');
                if (qs[0] == 'page') {
                    pg = qs[1];
                    break;
                }
            }
            return pg;
        }

        var pg = getPaginationSelectedPage('{{url('/newsread/comments/'.$new->id.'?page=1')}}');
        $.ajax({
            url: '{{url('/newsread/comments/'.$new->id)}}',
            data: {
                page: pg
            },
            success: function(data) {
                $('#comments').append(data);
            }
        });

        $('#comments').on('click', '.pagination.next-comments a', function(e) {
            e.preventDefault();
            pg = getPaginationSelectedPage($(this).attr('href'));
            $.ajax({
                url: '{{url('/newsread/comments/'.$new->id)}}',
                data: {
                    page: pg
                },
                success: function(response) {
                    $('#comments .pagination.next-comments').remove();
                    if(addedComment){
                        $('#comments').children().last().remove();
                        addedComment = false;
                    }
                    $('#comments').append(response);
                }
            });
        });

        $('#comments').on('click', '.pagination.next-reply a', function(e) {
            e.preventDefault();
            pg = getPaginationSelectedPage($(this).attr('href'));
            var comment_id = $(this).attr('href').substring($(this).attr('href').lastIndexOf('/')+1, $(this).attr('href').indexOf('?'));
            console.log(comment_id);
            $.ajax({
                url: '{{url('/newsread/replies')}}'+'/'+comment_id,
                data: {
                    page: pg
                },
                success: function(response) {
                    $('#comments .pagination.next-reply').remove();
                    $('#comment-replies-panel-'+comment_id).append(response);
                }
            });
        });

        function getTranslate(id, language){
            $.get('{{ url('/newsread/translate') }}'+'/'+id, function(data) {
                //console.log(data);
                $('#new_title').html(data.title);
                $('#new_text').html(data.text);
                var selected_content = $('#language-'+language).html();
                $('#selected-language').html(selected_content);
                $('#print-btn').attr('href', '{{url('/print')}}'+'/'+id);
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

                        if(reply === 1){
                            $.get("{{ url('/comment/reply/') }}"+'/'+response.id).done( function (data) {
                                $('#comment-replies-panel-'+replied_id).prepend(data);
                                $('#reply_count_'+replied_id).text(parseInt($('#reply_count_'+replied_id).text()) + 1);
                                window.location.hash = '#comment-panel-'+response.id;
                                reply = 0;
                                replied_id = null;
                            });
                        }else if(reply === 0){
                            $.get("{{ url('/comment/comment/') }}"+'/'+response.id).done( function (data) {
                                $('#comments').prepend(data);
                                addedComment = true;
                                window.location.hash = '#comment-panel-'+response.id;
                            });
                        }
                        $('#comments-count').html(response.count);
                    });
                @endif
            }else{
                $('#comment-result').removeClass().addClass('text-danger').html("Пікір енгізіңіз!");
            }
            //setTimeout(function() { $("#comment-result").removeClass().addClass('text-info').html('Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз'); }, 2000);
        });
    </script>
@endsection