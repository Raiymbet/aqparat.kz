@extends('layouts.home')

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="hpanel forum-box">
                    <div class="panel-heading hbuilt">
                        <ol class="hbreadcrumb breadcrumb">
                            <li><a href="#">Негізгі бет</a></li>
                            <li class="active">
                                <span>{{ $category }}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="panel-body hblue" style="min-height: 1200px">
                        <div class="row row-with-margin">

                            @foreach($news as $index => $new)
                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left @if($index%3==0) clear-left @endif">
                                    <a href="{{ url('/newsread/'.$new->id) }}">
                                        <img class="img-responsive image-main-news" src="{{ asset($new->avatar_picture) }}">
                                        <h5>{{ $new->title }}</h5>
                                        <p class="news-datetime">{{ $new->created_at }}</p>
                                        <div class="small statistics-style">
                                            <span><i class="fa fa-eye"></i>{{ $new->views }}</span>
                                            <span><i class="fa fa-comment"></i>{{ $new->comments_count() }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection
