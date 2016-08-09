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
                                <img src="{{ URL::asset($columnist->avatar) }}" alt="Қолданушы суреті">
                            </div>
                            <div class="media-body">
                                <div class="media-heading">
                                    <h4>
                                        {{ $columnist->name }}
                                        <br>
                                        <small><a href="#">{{ $columnist->email }}</a></small>
                                    </h4>
                                </div>
                                <p>
                                    @if(!is_null($columnist->adminDetails))
                                        {{ $columnist->adminDetails->about }}
                                    @endif
                                </p>
                                <p>
                                    <address>
                                        @if(!is_null($columnist->adminDetails))
                                            {{ $columnist->adminDetails->location }}
                                        @endif
                                    </address>
                                </p>
                                <p>
                                    <div class="btn-group">
                                        @if(!is_null($columnist->adminDetails))
                                            @if(!is_null( $columnist->adminDetails->facebook ))
                                                <a href="{{ $columnist->adminDetails->facebook }}">
                                                    <i class="fa fa-facebook btn btn-default btn-xs"></i>
                                                </a>
                                            @endif
                                            @if(!is_null( $columnist->adminDetails->twitter ))
                                                <a href="{{ $columnist->adminDetails->twitter }}">
                                                    <i class="fa fa-twitter btn btn-default btn-xs"></i>
                                                </a>
                                            @endif
                                            @if(!is_null( $columnist->adminDetails->linkedIn ))
                                                <a href="{{ $columnist->adminDetails->linkedIn }}">
                                                    <i class="fa fa-linkedin btn btn-default btn-xs"></i>
                                                </a>
                                            @endif
                                            @if(!is_null( $columnist->adminDetails->googlePlus ))
                                                <a href="{{ $columnist->adminDetails->googlePlus }}">
                                                    <i class="fa fa-google-plus btn btn-default btn-xs"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" style="min-height: 1200px">
                        <h4>Жазылымдары: <span class="text-info">{{ $columnist->newsCount() }}</span></h4>

                        <div class="row row-with-margin">
                            <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
                            @foreach($news as $index => $new)
                                <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left @if($index%3==0) clear-left @endif">
                                    <a href="{{ url('/newsread/'.$new->id) }}">
                                        <img class="img-responsive image-main-news" src="{{ asset($new->avatar_picture) }}">
                                        <h5 class="{{ $colors[$index%4] }}">{{ $new->category->name }}</h5>
                                        <h5>{{ $new->title }}</h5>
                                        <p class="news-datetime">{{ $new->created_at }}</p>
                                        <div class="small statistics-style">
                                            <span><i class="fa fa-eye"></i>{{ $new->views }}</span>
                                            <span><i class="fa fa-comment"></i>{{ $new->comments_count() }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            <div id="pagination" class="pagination">
                                {!! $news->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="jarnama" class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right">
                <div class="hpanel hred">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Жарнама</h6>
                    </div>
                    <div class="panel-body">
                        <p>Ақпараттандыру сайты туралы жарнамалар салуға болады</p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right">
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

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right">
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

            <div id="" class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection