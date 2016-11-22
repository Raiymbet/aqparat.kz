@extends('layouts.home')


@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">Columnists</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="media">
                                            <div class=" pull-left media-image">
                                                <img class="img-responsive" height="100" width="100" src="{{ URL::asset($columnist->avatar) }}" alt="Қолданушы суреті">
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <h4 class="text-uppercase no-margin">
                                                        <strong>{{ $columnist->name }}</strong>
                                                    </h4>
                                                    <h4 class="no-margin">
                                                        <small><a href="#">{{ $columnist->email }}</a></small>
                                                    </h4>
                                                </div>
                                                <p class="columnist-info-text" style="font-weight: 400; line-height: 26px;">
                                                    @if(!is_null($columnist->adminDetails))
                                                        {{ $columnist->adminDetails->about }}
                                                    @endif
                                                </p>
                                                <p>
                                                <address>
                                                    @if(!is_null($columnist->adminDetails))
                                                        <strong>{{ $columnist->adminDetails->location }}</strong>
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
                                </div>
                            </div>

                            <div id="jarnama" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pull-right">
                                <!-- AdSense -->
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-md" style="">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h4><strong>Жазылымдары:</strong> <span class="text-info">{{ $columnist->publishedNewsCount() }}</span></h4>
                                        <div class="row" id="columnist-news">

                                        </div>
                                    </div>
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

        $( function () {
            var screen_size = $(window).width(),
                    screen_type = '',
                    columnist_id = '{{ $columnist->id }}';
            if(screen_size>990){
                screen_type = 'lg';
                //$('#columnist-news').load('');
            }else if(screen_size<=990 && screen_size>=768){
                screen_type = 'sm';
                $('#columnist-news').load('{{url('/news/ajax/columnist_news?screen=sm&page=1')}}');
            }else if(screen_size<768){
                screen_type = 'xs';
                $('#columnist-news').load('{{url('/news/ajax/columnist_news?screen=xs&page=1')}}');
            }
            var pg = getPaginationSelectedPage('{{url('/news/ajax/columnist_news?page=1')}}');
            $.ajax({
                url: '{{url('/news/ajax/columnist_news')}}',
                data: {
                    page: pg,
                    screen: screen_type,
                    columnist: columnist_id
                },
                success: function(data) {
                    $('#columnist-news .pagination').remove();
                    $('#columnist-news').append(data);
                }
            });
            //console.log(screen_type);

            $('#columnist-news').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/columnist_news')}}',
                    data: {
                        page: pg,
                        screen: screen_type,
                        columnist: columnist_id
                    },
                    success: function(data) {
                        $('#columnist-news .pagination').remove();
                        $('#columnist-news').append(data);
                    }
                });
            });
        });
    </script>
@endsection