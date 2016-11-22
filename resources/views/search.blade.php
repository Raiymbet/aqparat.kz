@extends('layouts.home')

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs"><strong>Іздеу</strong></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">

                <div id="jarnama" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 pull-right p-r-xs">
                    <!-- Jarnama ushin arnalgan oryn -->
                    <div class="">
                        <img src="{{ asset('img/adsense.png') }}" class="img-responsive">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="hpanel forum-box">
                        <div class="panel-body">
                            <form id="advanced_search_form" class="form-horizontal">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-xs-3 col-sm-3 col-md-2 col-lg-2 control-label">Мәтіні:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                            <input id="search_text" class="form-control" type="text" placeholder="Жаңалық мәтіні...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Санаты:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                            <select id="search_category" class="form-control" name="new_category">
                                                <option value="all" selected="">Барлығы</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Уақыты:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                            <input id="search_date" type="date" class="form-control" placeholder="Уақытын көрсетіңіз">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <button class="btn btn-info pull-right" type="submit">Іздеу</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div id="search-news-content">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        var search_text,
                search_category,
                search_date;

        $('#advanced_search_form').submit( function (event) {
            event.preventDefault();

            search_text = $('#search_text').val();
            search_category = ($('#search_category').val()=='all')?null:$('#search_category').val();
            search_date = $('#search_date').val();
            if(search_date=='')
                search_date = null;
            //console.log('Text: '+search_text);
            //console.log('Category: '+search_category);
            //console.log('Date: '+search_date);

            $.get("{{ url('/search/new') }}", {
                Category : search_category,
                Text : search_text,
                DateTime : search_date
            }).done( function (data) {
                //console.log(data);
                $('#search-news-content').html(data);
            });
        });

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

        $('#search-news-content').on('click', '.pagination a', function(e) {
            e.preventDefault();
            pg = getPaginationSelectedPage($(this).attr('href'));
            $.ajax({
                url: '{{url('/search/new')}}',
                data: {
                    page: pg,
                    Category : search_category,
                    Text : search_text,
                    DateTime : search_date
                },
                success: function(data) {
                    $('#search-news-content .pagination').remove();
                    $('#search-news-content').append(data);
                }
            });
        });

        /*
        function getPosts(page) {
            $.ajax({
                url : '?page=' + page,
                dataType: 'json'
            }).done(function (data) {
                console.log(data);
                $('#news_items').html(data);
                location.hash = page;
            }).fail(function () {
                alert('News could not be loaded.');
            });
        }
        */
    </script>
@endsection
