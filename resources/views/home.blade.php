@extends('layouts.home')

@section('head')
    <!-- Start WOWSlider.com HEAD section
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('engine0/style.css') }}">
    <script type="text/javascript" src="{{ URL::asset('engine0/jquery.js') }}"></script>
    <!-- End WOWSlider.com HEAD section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three" style="">
        <div class="row header-row">
            <div class="row-content">

                <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="hpanel">
                        <div class="panel-body" style="padding: 14px;">
                            <span>
                                <i class="fa fa-dollar fa-lg m-r-lg"></i>USD: 354<br>
                                <i class="fa fa-euro fa-lg m-r-lg"></i>EUR: 455<br>
                                <i class="fa fa-ruble fa-lg m-r-lg"></i>RU: 5
                            </span>
                        </div>
                    </div>
                </div>-->

                <div id="jarnama" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pull-right m-t">
                    <!-- Jarnama ushin arnalgan oryn -->
                </div>

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pull-left">
                    <div class="">
                        <div class="panel-body m-b-lg m-t-none border-none">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 pull-left"
                                     style="padding-bottom: 10px; padding-left: 0; border-bottom: 1px solid #e4e5e7;">
                                    <form id="post_form">
                                        {{ csrf_field() }}
                                        <div class="form-group m-b-none">
                                            <textarea id="post_textarea" class="form-control textarea-infocus" rows="1"
                                                      name="text" placeholder="Не хабар?"></textarea>
                                        </div>

                                        <div id="post-result" class=""></div>

                                        <div id="post-media-content" class="form-group m-t"
                                             style="padding-bottom: 10px; border-bottom: 1px solid #ede9e0;"></div>

                                        <div id="post-video-content" class="form-group m-t"
                                             style="padding-bottom: 10px; border-bottom: 1px solid #ede9e0;">
                                            <label class="control-label">
                                                Видео жазба сілтемесі
                                            </label>
                                            <div class="input-group">
                                                <input type="url" id="post-video-url" class="form-control"
                                                       placeholder="Video url" aria-describedby="btn-addon">
                                                <a class="input-group-addon btn btn-default" role="button"
                                                   id="btn-addon" onclick="setVideoUrl()">Ok</a>
                                            </div>
                                        </div>

                                        <div id="post_submit" class="form-group hidden m-t">
                                            <button type="submit" id="post_btn" class="btn btn-info pull-right">
                                                Хабарла
                                            </button>

                                            <div class="pull-left">
                                                <input type="file" id="post-image" name="post-image" class="inputfile"
                                                       accept="image/gif, image/jpeg, image/png"
                                                       onchange="readURL(this)">
                                                <label for="post-image">
                                                    <a role="button" id="btn_image" class="pull-left">
                                                        <i class="fa fa-camera fa-lg"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="pull-left">
                                                <label>
                                                    <a role="button" id="btn_videocamera" class="pull-left m-l-sm">
                                                        <i class="fa fa-video-camera fa-lg"></i>
                                                    </a>
                                                </label>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 pull-right" id="slider-tab-wrapper">
                                    <ul class="list-unstyled nav nav-tabs" id="slider_tabs" style="">
                                        @foreach($slider_news as $index => $slider_new)
                                            <li role="presentation" class="text-center @if($index==0) active @endif">
                                                <a href="#menu-slider-{{$index}}"  aria-controls="menu-slider-{{$index}}" role="tab" data-toggle="tab">
                                                    <span class="text-uppercase {{ $colors[$index%4] }}">{{ $slider_new->news->category->name }}</span>
                                                    <p class="slider-tab-title"><strong>{{ $slider_new->news->title }}</strong></p>
                                                    <p class="m-b-none">By <span class="text-uppercase"><u>{{ $slider_new->news->author->name }}</u></span></p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-sm-8 col-md-8 col-lg-8 p-l-none" id="slider-tab-content">
                                    <div class="tab-content">
                                        @foreach($slider_news as $index => $slider_new)
                                            <div role="tabpanel" id="menu-slider-{{$index}}"
                                                 class="tab-pane slider-tab fade @if($index==0) in active @endif">
                                                <h4 class="text-uppercase {{ $colors[$index%4] }}">
                                                    <strong>
                                                        {{ $slider_new->news->category->name }}
                                                    </strong>
                                                </h4>
                                                <a href="{{ url('/newsread/'.$slider_new->news->id) }}">
                                                    <h3 class="slider-tab-content-title">
                                                        <strong>{{ $slider_new->news->title }}</strong>
                                                    </h3>
                                                </a>
                                                <p>
                                                    <span>By</span>
                                                    <a href="{{ url('/columnist/'.$slider_new->news->author->id) }}">
                                                        <strong class="text-uppercase"><u>{{ $slider_new->news->author->name }}</u></strong>
                                                    </a>,
                                                    <span>{{ $slider_new->news->created_at->format('F j,Y, H:i') }}</span>
                                                </p>
                                                <div class="media m-t-lg">
                                                    <a href="#" class="slider-image-content">
                                                        <img style="" class="media-object img-responsive"
                                                             src="{{ asset($slider_new->news->avatar_picture) }}"
                                                             alt="...">
                                                    </a>
                                                    <h4 class="slider-content-text">{!! str_limit(strip_tags($slider_new->news->text), 400) !!}</h4>
                                                    <br>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row-recommend"
                         style=""></div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-md" style="padding: 0;">
                        <ul class="list-unstyled nav nav-tabs text-uppercase" id="news_tabs">
                            <li class="active">
                                <a href="#tab_news">Таңдалған</a>
                            </li>
                            <li>
                                <a href="#tab_latest_news">Соңғы</a>
                            </li>
                            <li>
                                <a href="#tab_popular_news">Көп оқылған</a>
                            </li>
                            <li>
                                <a href="#tab_posted_news">Жолдамалар</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab_news" class="tab-pane fade in active">
                            <div class="row m-t-md" id="main-news"></div>
                        </div>
                        <div id="tab_latest_news" class="tab-pane fade in">
                            <div class="row m-t-md" id="last-news"></div>
                        </div>

                        <div id="tab_popular_news" class="tab-pane fade in">
                            <div class="row m-t-md" id="popular-news"></div>
                        </div>

                        <div id="tab_posted_news" class="tab-pane fade in">
                            <div class="row m-t-md" id="posted-news"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var videoEmbed = {
            invoke: function (url) {
                $('#post-media-content').append(videoEmbed.convertMedia(url));
            },
            convertMedia: function (html) {
                var pattern1 = /(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/?(.+)/g;
                var pattern2 = /(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g;

                if (pattern1.test(html)) {
                    var replacement = '<iframe width="420" height="345" src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

                    var html = html.replace(pattern1, replacement);
                }


                if (pattern2.test(html)) {
                    var replacement = '<iframe width="420" height="345" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
                    var html = html.replace(pattern2, replacement);
                }

                console.log(html);
                return html;
            }
        };

        function setVideoUrl() {
            var video_url = $('#post-video-url').val();
            $('#post-video-content').hide();
            console.log(video_url);
            videoEmbed.invoke(video_url);
            $('#post-media-content').show();
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#post-media-content').show().append('<img class="img-responsive" src="' + e.target.result + '" />');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $( function () {
            $('#post-media-content').hide();
            $('#post-video-content').hide();

            var tabCarousel = setInterval(function () {
                var tabs = $('#slider_tabs>li'),
                        active = tabs.filter('.active'),
                        next = active.next('li'),
                        toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

                toClick.tab('show');
                //console.log('Changed Slider');
            }, 6000);

            $('#news_tabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $('#post_form').submit(function (event) {
                event.preventDefault();

                $post_text = $('#post_textarea').val();
                if ($post_text) {
                        @if(Auth::guest()){
                        window.location.replace('{{url('/login')}}');
                    }
                    @else
                                        $.post("{{ url('/post') }}", {
                        text: $post_text
                    }).done(function (data) {
                        $('#post-result').removeClass().addClass('text-success').html(data);
                    });
                    @endif
                } else {
                    $('#post-result').removeClass().addClass('text-danger').html("Хабарлама енгізіңіз!");
                }

                setTimeout(function () {
                    $("#post-result").html('');
                }, 2000);
                $('#post_textarea').val('').attr('rows', 1);
                $('#post_submit').addClass('hidden');
                //$('#post_btn').addClass('hidden');
                //$('#btn_image').addClass('hidden');
                //$('#btn_videocamera').addClass('hidden');
                $('#post-media-content').html('').hide();
            });

            $('#post_textarea').focus(function () {
                $(this).attr('rows', 4);
                $('#post_submit').removeClass('hidden');
                //$('#post_btn').removeClass('hidden');
                //$('#btn_image').removeClass('hidden');
                //$('#btn_videocamera').removeClass('hidden');
            });

            $('#btn_videocamera').click(function () {
                $('#post-video-content').show();
            });

            var screen_size = $(window).width(),
                    screen_type = '';
            if(screen_size>990){
                screen_type = 'lg';
                $('#main-news').load('{{url('/news/ajax/main_news?screen=lg&page=1')}}');
                $('#last-news').load('{{url('/news/ajax/last_news?screen=lg&page=1')}}');
                $('#popular-news').load('{{url('/news/ajax/popular_news?screen=lg&page=1')}}');
                $('#posted-news').load('{{url('/news/ajax/posted_news?screen=lg&page=1')}}');
            }else if(screen_size<=990 && screen_size>=768){
                screen_type = 'sm';
                $('#main-news').load('{{url('/news/ajax/main_news?screen=sm&page=1')}}');
                $('#last-news').load('{{url('/news/ajax/last_news?screen=sm&page=1')}}');
                $('#popular-news').load('{{url('/news/ajax/popular_news?screen=sm&page=1')}}');
                $('#posted-news').load('{{url('/news/ajax/posted_news?screen=sm&page=1')}}');
            }else if(screen_size<768){
                screen_type = 'xs';
                $('#main-news').load('{{url('/news/ajax/main_news?screen=xs&page=1')}}');
                $('#last-news').load('{{url('/news/ajax/last_news?screen=xs&page=1')}}');
                $('#popular-news').load('{{url('/news/ajax/popular_news?screen=xs&page=1')}}');
                $('#posted-news').load('{{url('/news/ajax/posted_news?screen=xs&page=1')}}');
            }
            //console.log(screen_type);

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

            $('#main-news').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/main_news')}}',
                    data: {
                        page: pg,
                        screen: screen_type
                    },
                    success: function(data) {
                        $('#main-news .pagination').remove();
                        $('#main-news').append(data);
                    }
                });
            });

            $('#last-news').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/last_news')}}',
                    data: {
                        page: pg,
                        screen: screen_type
                    },
                    success: function(data) {
                        $('#last-news .pagination').remove();
                        $('#last-news').append(data);
                    }
                });
            });

            $('#popular-news').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/popular_news')}}',
                    data: {
                        page: pg,
                        screen: screen_type
                    },
                    success: function(data) {
                        $('#popular-news .pagination').remove();
                        $('#popular-news').append(data);
                    }
                });
            });

            $('#posted-news').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/posted_news')}}',
                    data: {
                        page: pg,
                        screen: screen_type
                    },
                    success: function(data) {
                        $('#posted-news .pagination').remove();
                        $('#posted-news').append(data);
                    }
                });
            });
        });
        /*$("#slider_tabs li").hover(function () {
            clearInterval(tabCarousel);
            $(this).find('a').tab('show');
        });*/
    </script>
@endsection