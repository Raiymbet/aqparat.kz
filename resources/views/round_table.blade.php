@extends('layouts.home')


@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">Round Table</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">

                            <div id="jarnama" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pull-right">
                                <!-- Jarnama ushin arnalgan oryn -->
                                <div class="m-b-lg">
                                    <img src="{{ asset('img/adsense.png') }}" class="img-responsive" style="height: 500px">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                <div class="row m-l-none m-r-none m-b-lg">
                                    <div class="col-sm-4 col-md-4 col-lg-4 pull-right" id="slider-tab-wrapper">
                                        <ul class="list-unstyled nav nav-tabs" id="slider_tabs" style="">
                                            @foreach($slider_news as $index => $slider_new)
                                                <li class="text-center @if($index==0) active @endif">
                                                    <a href="{{ url('/newsread/'.$slider_new->id) }}">
                                                        <p class="slider-tab-title"><strong>{{ $slider_new->title }}</strong></p>
                                                        <p class="m-b-none">By <span class="text-uppercase"><u>{{ $slider_new->author->name }}</u></span></p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-sm-8 col-md-8 col-lg-8" id="slider-tab-content" style="position:relative;">
                                        @foreach($slider_news as $index => $slider_new)
                                            <div id="menu-slider-{{$index}}"
                                                 class="slider-tab  @if($index==0)active @endif" style="@if($index!=0) display:none; @endif">
                                                <a href="{{ url('/newsread/'.$slider_new->id) }}">
                                                    <h3 class="slider-tab-content-title">
                                                        <strong>{{ $slider_new->title }}</strong>
                                                    </h3>
                                                </a>
                                                <p>
                                                    <span>By</span>
                                                    <a href="{{ url('/columnist/'.$slider_new->author->id) }}">
                                                        <strong class="text-uppercase"><u>{{ $slider_new->author->name }}</u></strong>
                                                    </a>,
                                                    <span>{{ $slider_new->created_at->format('F j, H:i') }}</span>
                                                </p>
                                                <div class="media">
                                                    <a href="#" class="carousel-image-container" style="background-image: url('{{asset($slider_new->avatar_picture)}}');">
                                                        @if(!is_null($slider_new->media_author))
                                                            <span class="image-author">{{$slider_new->media_author}}</span>
                                                        @endif
                                                        @if(!is_null($slider_new->video_url))
                                                            <span class="image-has-video">
                                                                    <i class="fa fa-video-camera"></i>
                                                                </span>
                                                        @endif
                                                    </a>
                                                    <h4 class="slider-content-text">
                                                        {!! str_limit(strip_tags($slider_new->text), 300) !!}
                                                        <a class="text-red" href="{{ url('/newsread/'.$slider_new->id) }}">Read more...</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="row-recommend"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="row m-t-md" id="category-news-content">

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right category-news-recommend" id="category-news-recommend">
                                <div class="row m-t-md m-l-md m-r-n-sm" style="background: #f1f0de;">
                                    <div class="chapter">
                                        <span>Соңғы ақпарат</span>
                                    </div>
                                    @foreach($last_news as $index => $last_new)
                                        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 pull-left p-xs" style="border-top: 1px solid #ccc;">
                                            <div class="media">
                                                <div class="media-left news-author-avatar">
                                                    <a href="{{ url('/newsread/'.$last_new->id) }}">
                                                        <img alt="64x64" class="media-object"
                                                             src="{{ asset($last_new->author->avatar) }}"
                                                             data-holder-rendered="true" width="80" height="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p class="m-t-xx3">
                                                        <span class="text-muted m-l-sm">{{ $last_new->created_at->format('F j, H:i') }}</span>
                                                    <span class="text-muted m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $last_new->comments_count() }}</span>
                                                    </p>
                                                    <h4 class="news-with-author-avatar-title">
                                                        <a href="{{ url('/newsread/'.$last_new->id) }}">
                                                            <strong>{{ $last_new->title }}</strong>
                                                        </a>
                                                    </h4>
                                                    <p>
                                                        <a href="{{ url('/columnist/'.$last_new->author->id) }}">
                                                            <strong class="text-uppercase"><u>{{ $last_new->author->name }}</u></strong>
                                                        </a>

                                                        {!! str_limit(strip_tags($last_new->short_description ), 50) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 m-t-md pull-right category-news-recommend">
                                <div class="row m-t-md m-l-md m-r-n-sm" style="background: #f1f0de;">
                                    <div class="chapter">
                                        <span>Көп оқылған</span>
                                    </div>
                                    @foreach($more_readed_news as $index => $more_readed_new)
                                        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 pull-left p-xs" style="border-top: 1px solid #ccc;">
                                            <div class="media">
                                                <div class="media-left news-author-avatar">
                                                    <a href="{{ url('/newsread/'.$more_readed_new->id) }}">
                                                        <img alt="64x64" class="media-object"
                                                             src="{{ asset($more_readed_new->author->avatar) }}"
                                                             data-holder-rendered="true" width="80" height="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p class="m-t-xx3">
                                                        <span class="text-muted m-l-sm">{{ $more_readed_new->created_at->format('F j, H:i') }}</span>
                                                    <span class="text-muted m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $more_readed_new->comments_count() }}</span>
                                                    </p>
                                                    <a href="{{ url('/newsread/'.$more_readed_new->id) }}">
                                                        <h4 class="news-with-author-avatar-title">
                                                            <strong>{{ $more_readed_new->title }}</strong>
                                                        </h4>
                                                    </a>
                                                    <p>
                                                        <a href="{{ url('/columnist/'.$more_readed_new->author->id) }}">
                                                            <strong class="text-uppercase"><u>{{ $more_readed_new->author->name }}</u></strong>
                                                        </a>
                                                        <span>
                                                            {!! str_limit(strip_tags($more_readed_new->short_description ), 50) !!}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 m-t-md pull-right category-news-recommend">
                                <div class="row m-t-md m-l-md m-r-n-sm" style="background: #f1f0de;">
                                    <div class="chapter">
                                        <span>Focus</span>
                                    </div>
                                    @foreach($focus_news as $index => $focus_new)
                                        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 pull-left p-xs" style="border-top: 1px solid #ccc;">
                                            <div class="media">
                                                <div class="media-left news-author-avatar">
                                                    <a href="{{ url('/newsread/'.$focus_new->id) }}">
                                                        <img alt="64x64" class="media-object"
                                                             src="{{ asset($focus_new->author->avatar) }}"
                                                             data-holder-rendered="true" width="80" height="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p class="m-t-xx3">
                                                        <span class="text-muted m-l-sm">{{ $focus_new->created_at->format('F j, H:i') }}</span>
                                                        <span class="text-muted m-l-sm">
                                                            <i class="fa fa-comment"></i>{{ $focus_new->comments_count() }}
                                                        </span>
                                                    </p>
                                                    <a href="{{ url('/newsread/'.$focus_new->id) }}">
                                                        <h4 class="news-with-author-avatar-title">
                                                            <strong>{{ $focus_new->title }}</strong>
                                                        </h4>
                                                    </a>
                                                    <p>
                                                        <a href="{{ url('/columnist/'.$focus_new->author->id) }}">
                                                            <strong class="text-uppercase"><u>{{ $focus_new->author->name }}</u></strong>
                                                        </a>
                                                        <span>
                                                            {!! str_limit(strip_tags($focus_new->short_description ), 50) !!}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

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
        $( function () {

            var tabCarousel = setInterval(function () {
                var tabs = $('#slider_tabs>li'),
                        menuTabs = $('#slider-tab-content .slider-tab'),
                        active = tabs.filter('.active'),
                        next = active.next('li'),
                        toactive = next.length ? next : tabs.eq(0),
                        menuActive = menuTabs.filter('.active'),
                        menuNext = menuActive.next('.slider-tab'),
                        menuToActive = menuNext.length ? menuNext : menuTabs.eq(0);

                active.removeClass('active');
                toactive.addClass('active');
                menuActive.removeClass('active').hide();
                if(menuToActive.hasClass('hidden'))
                    menuToActive.removeClass('hidden');
                menuToActive.addClass('active').fadeIn('');
                //console.log(active.id);
                //console.log('Changed Slider');
            }, 6000);

            var category_id = '{{ $category }}';

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

            var pg = getPaginationSelectedPage('{{url('/news/ajax/round_table?page=1')}}');
            $.ajax({
                url: '{{url('/news/ajax/round_table')}}',
                data: {
                    page: pg,
                    category: category_id
                },
                success: function(data) {
                    $('#category-news-content .pagination').remove();
                    $('#category-news-content').append(data);
                }
            });

            $('#category-news-content').on('click', '.pagination a', function(e) {
                e.preventDefault();
                pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/round_table')}}',
                    data: {
                        page: pg,
                        category: category_id
                    },
                    success: function(data) {
                        $('#category-news-content .pagination').remove();
                        $('#category-news-content').append(data);
                    }
                });
            });
        });
    </script>
@endsection