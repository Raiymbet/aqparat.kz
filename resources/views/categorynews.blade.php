@extends('layouts.home')

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs"><strong>{{ $category->name }}</strong></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="hpanel ">
                        <div class="panel-body hblue" style="min-height: 1200px">

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4 col-lg-4 pull-right" id="slider-tab-wrapper">
                                        <ul class="list-unstyled nav nav-tabs" id="slider_tabs" style="">
                                            @foreach($slider_news as $index => $slider_new)
                                                <li role="presentation" class="text-center @if($index==0) active @endif">
                                                    <a href="#menu-slider-{{$index}}"  aria-controls="menu-slider-{{$index}}" role="tab" data-toggle="tab">
                                                        <p class="slider-tab-title"><strong>{{ $slider_new->title }}</strong></p>
                                                        <p class="m-b-none">By <span class="text-uppercase"><u>{{ $slider_new->author->name }}</u></span></p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-sm-8 col-md-8 col-lg-8" id="slider-tab-content">
                                        <div class="tab-content">
                                            @foreach($slider_news as $index => $slider_new)
                                                <div role="tabpanel" id="menu-slider-{{$index}}"
                                                     class="tab-pane fade @if($index==0) in active @endif">
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
                                                        </a>
                                                        <h4 class="slider-content-text">{!! str_limit(strip_tags($slider_new->text), 300) !!}</h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 m-t-xl pull-right" id="category-news-recommend">
                                <div class="row" style="background: #f1f0de;">
                                    <div class="chapter">
                                        <span>Бөлім жаңалықтары</span>
                                    </div>
                                    @foreach($latestNewsPerCategory as $index => $new)
                                        <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 pull-left p-xs" style="border-top: 1px solid #ccc;">
                                            <div class="media">
                                                <div class="media-left news-author-avatar" style="">
                                                    <a href="{{ url('/newsread/'.$new->id) }}">
                                                        <img alt="64x64" class="media-object"
                                                             src="{{ asset($new->author->avatar) }}"
                                                             data-holder-rendered="true" width="80" height="80">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <p class="m-t-xx3">
                                                        <a href="{{ url('/categorynews/'.$new->category->id) }}"
                                                           class="{{ $colors[$index%4] }} text-uppercase p-r-l-xxs"
                                                           style="border: 1px solid;">
                                                            <strong>
                                                                @if ($new->category->type=='point')
                                                                    Round Table
                                                                @elseif ($new->category->type=='focus')
                                                                    Focus
                                                                @else
                                                                    {{ $new->category->name }}
                                                                @endif
                                                            </strong>
                                                        </a>
                                                        <span class="text-muted m-l-sm">{{ $new->created_at->format('M j, H:i') }}</span>
                                                        <span class="text-muted m-l-sm">
                                                            <i class="fa fa-comment"></i>{{ $new->comments_count() }}
                                                        </span>
                                                    </p>
                                                    <h4 class="news-with-author-avatar-title">
                                                        <a href="{{ url('/newsread/'.$new->id) }}">
                                                            <strong>{{ $new->title }}</strong>
                                                        </a>
                                                    </h4>
                                                    <p>
                                                        <a href="{{ url('/columnist/'.$new->author->id) }}">
                                                            <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                                                        </a>
                                                        {!! str_limit(strip_tags($new->short_description ), 50) !!}
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
            var category_id = '{{ $category->id }}';

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

            var pg = getPaginationSelectedPage('{{url('/news/ajax/category_news?page=1')}}');
            $.ajax({
                url: '{{url('/news/ajax/category_news')}}',
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
                    url: '{{url('/news/ajax/category_news')}}',
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
