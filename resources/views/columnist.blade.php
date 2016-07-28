@extends('layouts.home')


@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="hpanel">
                    <div class="panel-heading hbuilt">
                        <ol class="hbreadcrumb breadcrumb">
                            <li><a href="#">Негізгі бет</a></li>
                            <li class="active">
                                <span>Columnists</span>
                            </li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-image pull-left">
                                <img src="{{ URL::asset('img/default_user.png') }}" alt="Қолданушы суреті">
                            </div>
                            <div class="media-body">
                                <div class="media-heading">{{ $columnist->name }}</div>
                                <p>bla vla...</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row row-with-margin">
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
                    <div class="panel-body" style="overflow-x: scroll">
                        <ul class="list-unstyled" id="posts-list">
                            @foreach($last_posts as $last_post)
                                <li>
                                    <a href="#">
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
@endsection

@section('script')
    <script type="text/javascript">
    </script>
@endsection