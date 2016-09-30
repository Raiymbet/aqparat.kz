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
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row" id="focus-news-content">

                                    <!--
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <figure class="rollover site">
                                            <a href="/sites/claraluna"><img width="700" height="500" src="http://www.awwwards.com/media/cache/thumb_sotm/awards/submissions/2016/08/57a494283dc10.jpeg" alt="Claraluna | CSS Website"></a>
                                        </figure>
                                        <div class="col-lg-10  p-l-sm">
                                            <h3><a href="/sites/claraluna">Claraluna</a></h3>

                                            <div class="">
                                                By <strong><a href="/aquest/">Aquest</a></strong>   from <strong>Italy</strong> with <strong>7.32</strong>
                                            </div>

                                            <div class="">
                                                August 05, 2016
                                                in <strong><a href="/awards-of-the-day/">SOTD</a></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-r-sm">
                                            <div class="pull-right">
                                                <i role="button" class="fa fa-thumbs-o-up fa-lg liked"></i>
                                                <span id="new_likes">23</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
                                        <figure class="rollover site">
                                            <a href="/sites/claraluna"><img width="700" height="500" src="http://www.awwwards.com/media/cache/thumb_sotm/awards/submissions/2016/08/57a494283dc10.jpeg" alt="Claraluna | CSS Website"></a>
                                        </figure>
                                        <div class="col-lg-10 p-l-sm">
                                            <h3><a href="/sites/claraluna">Claraluna</a></h3>

                                            <div class="">
                                                By <strong><a href="/aquest/">Aquest</a></strong>   from <strong>Italy</strong> with <strong>7.32</strong>
                                            </div>

                                            <div class="">
                                                August 05, 2016
                                                in <strong><a href="/awards-of-the-day/">SOTD</a></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-r-sm">
                                            <div class="pull-right">
                                                <i role="button" class="fa fa-thumbs-o-up fa-lg liked"></i>
                                                <span id="new_likes">23</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <figure class="rollover site">
                                            <a href="/sites/claraluna"><img width="700" height="500" src="http://www.awwwards.com/media/cache/thumb_sotm/awards/submissions/2016/08/57a494283dc10.jpeg" alt="Claraluna | CSS Website"></a>
                                        </figure>
                                        <div class="col-lg-10 p-l-sm">
                                            <h3><a href="/sites/claraluna">Claraluna</a></h3>

                                            <div class="">
                                                By <strong><a href="/aquest/">Aquest</a></strong>   from <strong>Italy</strong> with <strong>7.32</strong>
                                            </div>

                                            <div class="">
                                                August 05, 2016
                                                in <strong><a href="/awards-of-the-day/">SOTD</a></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-r-sm">
                                            <div class="pull-right">
                                                <i role="button" class="fa fa-thumbs-o-up fa-lg liked"></i>
                                                <span id="new_likes">23</span>
                                            </div>
                                        </div>
                                    </div>-->

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

            var pg = getPaginationSelectedPage('{{url('/news/ajax/focus?page=1')}}');
            $.ajax({
                url: '{{url('/news/ajax/focus')}}',
                data: {
                    page: pg,
                    category: category_id
                },
                success: function(data) {
                    $('#focus-news-content .pagination').remove();
                    $('#focus-news-content').append(data);
                }
            });

            $('#focus-news-content').on('click', '.pagination a', function(e) {
                e.preventDefault();
                pg = getPaginationSelectedPage($(this).attr('href'));
                $.ajax({
                    url: '{{url('/news/ajax/focus')}}',
                    data: {
                        page: pg,
                        category: category_id
                    },
                    success: function(data) {
                        $('#focus-news-content .pagination').remove();
                        $('#focsu-news-content').append(data);
                    }
                });
            });
        });
    </script>
@endsection