@extends('layouts.home')

@section('head')
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('engine0/style.css') }}">
    <script type="text/javascript" src="{{ URL::asset('engine0/jquery.js') }}"></script>
    <!-- End WOWSlider.com HEAD section -->
@endsection

@section('content')
    <div class="">
        <div class="content">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                    <div class="hpanel">
                        <div class="panel-body">
                            <form id="post_form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea id="post_textarea" class="form-control textarea-infocus" rows="1" name="text" placeholder="Не хабар?"></textarea>
                                </div>
                                <div id="post-result" class=""></div>
                                <div class="form-group">
                                    <button type="submit" id="post_btn" class="btn btn-info pull-right hidden">Хабарла</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="hpanel">
                        <div class="panel-body">
                            <!-- Start WOWSlider.com BODY section-->
                            <div id="wowslider-container0">
                                <div class="ws_images">
                                    <ul>
                                        @foreach($slider_news as $index => $slider_new)
                                            <li>
                                                <img src="data0/images/{{ $slider_new->news->id }}.jpg"
                                                     alt="{{ $slider_new->news->title }}" title="{{ $slider_new->news->title }}"
                                                     id="wows0_{{ $index }}">
                                            </li>
                                        @endforeach
                                        <!--<li><img src="data0/images/_48351578_640x360worldnews.jpg" alt="News 1" title="News 1" id="wows0_0"/></li>
                                        <li><img src="data0/images/getarticleimage.jpg" alt="GetArticleImage" title="GetArticleImage" id="wows0_1"/></li>
                                        <li><img src="data0/images/news.jpg" alt="news" title="news" id="wows0_2"/></li>
                                        <li><img src="data0/images/news_765x350px.jpg" alt="jquery slideshow" title="News4" id="wows0_3"/></li>
                                        <li><img src="data0/images/news_events.jpg_687647283.jpg" alt="News 5" title="News 5" id="wows0_4"/></li>-->
                                    </ul>
                                </div>
                                <div class="ws_bullets">
                                    <div>
                                        @foreach($slider_news as $index => $slider_new)
                                            <a href="#" title="{{ $slider_new->news->title }}">
                                                <span>
                                                    <img src="data0/tooltips/{{ $slider_new->news->id }}.jpg" alt="{{ $slider_new->news->title }}">
                                                    {{ $index }}
                                                </span>
                                            </a>
                                        @endforeach
                                        <!--<a href="#" title="News 1"><span><img src="data0/tooltips/_48351578_640x360worldnews.jpg" alt="News 1"/>1</span></a>
                                        <a href="#" title="GetArticleImage"><span><img src="data0/tooltips/getarticleimage.jpg" alt="GetArticleImage"/>2</span></a>
                                        <a href="#" title="news"><span><img src="data0/tooltips/news.jpg" alt="news"/>3</span></a>
                                        <a href="#" title="News4"><span><img src="data0/tooltips/news_765x350px.jpg" alt="News4"/>4</span></a>
                                        <a href="#" title="News 5"><span><img src="data0/tooltips/news_events.jpg_687647283.jpg" alt="News 5"/>5</span></a>-->
                                    </div>
                                </div>
                                <!--<div class="ws_script" style="position:absolute;left:-99%">by WOWSlider.com v8.7</div>-->
                                <div class="ws_shadow"></div>
                            </div>
                            <script type="text/javascript" src="{{ URL::asset('engine0/wowslider.js') }}"></script>
                            <script type="text/javascript" src="{{ URL::asset('engine0/script.js') }}"></script>
                            <!-- End WOWSlider.com BODY section-->
                        </div>
                    </div>

                    <div class="hpanel hgreen">
                        <div class="panel-heading hbuilt">
                            <h6>Басты жаңалықтар</h6>
                            <div class="panel-tools">
                                <a href="{!! $main_news->previousPageUrl() !!}" class="btn btn-xs btn-default">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                                <a href="{!! $main_news->nextPageUrl() !!}" class="btn btn-xs btn-default">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body hblue">
                            <div class="row row-with-margin">
                                <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
                                @foreach($main_news as $index => $main_new)
                                    <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left @if($index%3==0) clear-left @endif">
                                        <a href="{{ url('/newsread/'.$main_new->id) }}">
                                            <img class="img-responsive image-main-news" src="{{ asset($main_new->avatar_picture) }}">
                                            <h5 class="{{ $colors[$index%4] }}">{{ $main_new->category->name }}</h5>
                                            <h5>{{ $main_new->title }}</h5>
                                            <p class="news-datetime">{{ $main_new->created_at }}</p>
                                            <div class="small statistics-style">
                                                <span><i class="fa fa-eye"></i>{{ $main_new->views }}</span>
                                                <span><i class="fa fa-comment"></i>{{ $main_new->comments_count() }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach


                                <!--
                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                    <img class="img-responsive image-main-news" src="{{ URL::asset('img/GetArticleImage.jpg') }}">
                                    <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                    <p class="news-datetime">September 10, 12:34</p>
                                    <div class="small statistics-style">
                                        <span><i class="fa fa-eye"></i>1287</span>
                                        <span><i class="fa fa-comment"></i>5</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                    <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                    <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                    <p class="news-datetime">September 10, 12:34</p>
                                    <div class="small statistics-style">
                                        <span><i class="fa fa-eye"></i>1287</span>
                                        <span><i class="fa fa-comment"></i>5</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left clear-left">
                                    <img class="img-responsive image-main-news" src="{{ URL::asset('img/GetArticleImage.jpg') }}">
                                    <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                    <p class="news-datetime">September 10, 12:34</p>
                                    <div class="small statistics-style">
                                        <span><i class="fa fa-eye"></i>1287</span>
                                        <span><i class="fa fa-comment"></i>5</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                    <img class="img-responsive image-main-news" src="{{ URL::asset('img/news_events.jpg') }}">
                                    <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                    <p class="news-datetime">September 10, 12:34</p>
                                    <div class="small statistics-style">
                                        <span><i class="fa fa-eye"></i>1287</span>
                                        <span><i class="fa fa-comment"></i>5</span>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                    <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                    <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                    <p class="news-datetime">September 10, 12:34</p>
                                    <div class="small statistics-style">
                                        <span><i class="fa fa-eye"></i>1287</span>
                                        <span><i class="fa fa-comment"></i>5</span>
                                    </div>
                                </div>
                                -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="hpanel hblue">
                        <div class="panel-heading hbuilt">
                            <h6 class="text-center">Соңғы жаңалықтар</h6>
                        </div>
                        <div class="panel-body" style="overflow-x: scroll">
                            <div id="last-news">
                                <ul class="list-unstyled" id="last-news-list">
                                    @foreach($last_news as $last_new)
                                        <li>
                                            <a href="{{ url('/newsread/'.$last_new->id) }}">
                                                <span class="news-datetime">{{ $last_new->created_at }}</span>
                                                <p>{{ $last_new->title }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-2">
                    <div class="hpanel hred">
                        <div class="panel-heading hbuilt">
                            <h6 class="text-center">Жарнама</h6>
                        </div>
                        <div class="panel-body">
                            <p>
                                Жарнама жазылатын мәтін орны.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="hpanel hgreen">
                        <div class="panel-heading hbuilt">
                            <h6 class="text-center">Көп оқылғандар</h6>
                        </div>
                        <div class="panel-body panel-scrollbar">
                            <div id="more-reads-news">
                                <ul class="list-unstyled" id="more-reads-news-list">
                                    @foreach($more_readed_news as $more_readed_new)
                                        <li>
                                            <a href="{{url('/newsread/'.$more_readed_new->id)}}">
                                                <span class="news-datetime">{{ $more_readed_new->created_at }}</span>
                                                <p>{{ $more_readed_new->title }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="hpanel horange">
                        <div class="panel-heading hbuilt">
                            <h6 class="text-center">Жолдамалар</h6>
                        </div>
                        <div class="panel-body" style="overflow-y: scroll;">
                            <ul class="list-unstyled" id="posts-list">
                                @foreach($last_posts as $last_post)
                                    <li>
                                        <a href="{{url('/newsread/'.$last_post->news_id)}}">
                                            <span><i class="fa fa-check-square-o fa-lg"></i></span>
                                            <span class="news-datetime">{{ $last_post->created_at }}</span>
                                            <p>{{ $last_post->text }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#post_form').submit( function (event) {
            event.preventDefault();

            $post_text = $('#post_textarea').val();
            if($post_text){
                @if(Auth::guest()){
                    window.location.replace('{{url('/login')}}');
                }@else
                    $.post("{{ url('/post') }}", {
                        text : $post_text
                    }).done( function (data) {
                        $('#post-result').removeClass().addClass('text-success').html(data);
                    });
                @endif
            }else{
                $('#post-result').removeClass().addClass('text-danger').html("Хабарлама енгізіңіз!");
            }

            setTimeout(function() { $("#post-result").html(''); }, 2000);
            $('#post_textarea').val('').attr('rows', 1);
            $('#post_btn').addClass('hidden');
        });

        $('#post_textarea').focus( function () {
            $(this).attr('rows', 4);
            $('#post_btn').removeClass('hidden');
        });

    </script>
@endsection