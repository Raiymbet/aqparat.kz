@extends('layouts.home')


@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">OnFocus</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="hpanel">
                    <div class="panel-body">

                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                            <div class="row">
                                <div class="col-lg-4 pull-right" id="tab-wrapper">
                                    <ul class="list-unstyled nav nav-tabs" id="slider_tabs" style="">
                                        @foreach($slider_news as $index => $slider_new)
                                            <li style="padding: 10px; margin-bottom: 2px; background: #cccccc;" role="presentation" class="text-center @if($index==0) active @endif">
                                                <a href="#menu-slider-{{$index}}"  aria-controls="menu-slider-{{$index}}" role="tab" data-toggle="tab">
                                                    <p><strong>{{ $slider_new->title }}</strong></p>
                                                    <p style="margin-bottom: 0;">By <span class="text-uppercase"><u>{{ $slider_new->author->name }}</u></span></p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="col-lg-8" style="padding-left: 10px;">
                                    <div class="tab-content">
                                        @foreach($slider_news as $index => $slider_new)
                                            <div role="tabpanel" id="menu-slider-{{$index}}"
                                                 class="tab-pane fade @if($index==0) in active @endif">
                                                <a href="{{ url('/newsread/'.$slider_new->id) }}"><h3>
                                                        <strong>{{ $slider_new->title }}</strong></h3></a>
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
                                                    <h4 style="font-size: 16px; line-height: 24px; margin-top: -7px;">{!! str_limit(strip_tags($slider_new->text), 300) !!}</h4>
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

                        @if(count($news)>0)
                            <div class="col-lg-8 pull-left">
                                @foreach($news as $index => $new)
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 news-thumbnail pull-left @if($index%2==0) clear-left @endif">
                                        <div style="border-top: 5px solid;">
                                            <a href="{{ url('/categorynews/'.$new->category->id) }}"><h5
                                                        class="{{ $colors[$index%4] }} text-uppercase">{{ $new->category->name }}</h5>
                                            </a>
                                            <a href="{{ url('/newsread/'.$new->id) }}">
                                                <img class="img-responsive image-main-news"
                                                     src="{{ asset($new->avatar_picture) }}">
                                                <p class="text-muted m-t-sm">
                                                    {{ $new->created_at->format('F j, H:i') }}
                                                    <span class="m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $new->comments_count() }}</span>
                                                </p>
                                                <h4><strong>{{ $new->title }}</strong></h4>
                                            </a>
                                            <p>
                                                <a href="{{ url('/columnist/'.$new->author->id) }}">
                                                    <strong class="text-uppercase"><u>{{ $new->author->name }}</u></strong>
                                                </a>
                                                <span>{{ $new->short_description }}</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="col-lg-4 m-t-md pull-right" style="background: #f1f0de; padding: 0;">
                            <div class="chapter">
                                <span>Соңғы ақпарат</span>
                            </div>
                            @foreach($last_news as $index => $last_new)
                                <div class="pull-left"
                                     style="padding: 10px; border-top: 1px solid #ccc;">
                                    <div class="media">
                                        <div class="media-left" style="padding-top: 10px">
                                            <a href="{{ url('/newsread/'.$last_new->id) }}">
                                                <img alt="64x64" class="media-object"
                                                     src="{{ asset($last_new->author->avatar) }}"
                                                     data-holder-rendered="true" style="width: 80px; height: 80px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="" style="margin-top: 3px;">
                                                <span class="text-muted m-l-sm">{{ $last_new->created_at->format('F j, H:i') }}</span>
                                                    <span class="text-muted m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $last_new->comments_count() }}</span>
                                            </p>
                                            <a href="{{ url('/newsread/'.$last_new->id) }}">
                                                <h4 class="media-heading" style="line-height: 20px; font-size: 17px;">
                                                    <strong>{{ $last_new->title }}</strong>
                                                </h4>
                                            </a>
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

                        <div class="col-lg-4 m-t-md pull-right" style="background: #f1f0de; padding: 0;">
                            <div class="chapter">
                                <span>Көп оқылған</span>
                            </div>
                            @foreach($more_readed_news as $index => $more_readed_new)
                                <div class="pull-left"
                                     style="padding: 10px; border-top: 1px solid #ccc;">
                                    <div class="media">
                                        <div class="media-left" style="padding-top: 10px">
                                            <a href="{{ url('/newsread/'.$more_readed_new->id) }}">
                                                <img alt="64x64" class="media-object"
                                                     src="{{ asset($more_readed_new->author->avatar) }}"
                                                     data-holder-rendered="true" style="width: 80px; height: 80px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="" style="margin-top: 3px;">
                                                <span class="text-muted m-l-sm">{{ $more_readed_new->created_at->format('F j, H:i') }}</span>
                                                    <span class="text-muted m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $more_readed_new->comments_count() }}</span>
                                            </p>
                                            <a href="{{ url('/newsread/'.$more_readed_new->id) }}">
                                                <h4 class="media-heading" style="line-height: 20px; font-size: 17px;">
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

                        <div class="col-lg-4 m-t-md pull-right" style="background: #f1f0de; padding: 0;">
                            <div class="chapter">
                                <span>Round Table</span>
                            </div>
                            @foreach($point_news as $index => $point_new)
                                <div class="pull-left"
                                     style="padding: 10px; border-top: 1px solid #ccc;">
                                    <div class="media">
                                        <div class="media-left" style="padding-top: 10px">
                                            <a href="{{ url('/newsread/'.$point_new->id) }}">
                                                <img alt="64x64" class="media-object"
                                                     src="{{ asset($point_new->author->avatar) }}"
                                                     data-holder-rendered="true" style="width: 80px; height: 80px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="" style="margin-top: 3px;">
                                                <span class="text-muted m-l-sm">{{ $point_new->created_at->format('F j, H:i') }}</span>
                                                    <span class="text-muted m-l-sm"><i
                                                                class="fa fa-comment"></i>{{ $point_new->comments_count() }}</span>
                                            </p>
                                            <a href="{{ url('/newsread/'.$point_new->id) }}">
                                                <h4 class="media-heading" style="line-height: 20px; font-size: 17px;">
                                                    <strong>{{ $point_new->title }}</strong>
                                                </h4>
                                            </a>
                                            <p>
                                                <a href="{{ url('/columnist/'.$point_new->author->id) }}">
                                                    <strong class="text-uppercase"><u>{{ $point_new->author->name }}</u></strong>
                                                </a>
                                                <span>
                                                    {!! str_limit(strip_tags($point_new->short_description ), 50) !!}
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
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection