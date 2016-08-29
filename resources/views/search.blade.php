@extends('layouts.home')

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>

    <div class="col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px; padding: 9px 50px;">
        <div class="header-row">
            <span class="m-l-xs"><strong>Іздеу</strong></span>
        </div>
    </div>
    <div class="col-lg-12 header-three">
        <div class="row header-row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
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
                                        <input id="search_date" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
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

                <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
                <div id="news_items">
                    @foreach($searchNews as $index => $searchNew)
                        <div class="hpanel filter-item">
                            <a href="{{ url('/newsread/'.$searchNew->id) }}">
                                <div class="panel-body">
                                    <h4 class=""><small>{{ $searchNew->created_at }}</small></h4>
                                    <h4>{{ $searchNew->title }}</h4>
                                    <p>{!! str_limit(strip_tags($searchNew->text), 100) !!}</p>
                                    <div class="text-left">
                                        <h5 class="{{ $colors[$index%4] }}">{{ $searchNew->category->name }}</h5>
                                    </div>
                                    <div class="small statistics-style">
                                        <span> <i class="fa fa-eye fa-lg"></i> {{ $searchNew->views }}</span>
                                        <span class="margin-left-20"> <i class="fa fa-comment fa-lg"></i> {{ $searchNew->comments_count() }}</span>
                                        <span  class="margin-left-20"> <i role="button" class="fa fa-heart fa-lg"></i> {{ $searchNew->likes }}</span>
                                        <span class="margin-left-20"> <i role="button" class="fa fa-share-alt fa-lg"></i> {{ $searchNew->shares }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div id="pagination" class="pagination">
                        {!! $searchNews->render() !!}
                    </div>
                </div>

                <div class="hpanel hblue">
                    <div class="panel-heading hbuilt">
                        <h6>Оқуға ұсынамыз</h6>
                    </div>
                    <div class="panel-body hblue">
                        <div class="row row-with-margin">
                            <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
                            @foreach($recommend_news as $index => $recommend_new)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 news-thumbnail text-justify pull-left @if($index%3==0) clear-left @endif">
                                    <a href="{{ url('/newsread/'.$recommend_new->id) }}">
                                        <img class="img-responsive image-main-news" src="{{ asset($recommend_new->avatar_picture) }}">
                                        <h5 class="{{ $colors[$index%4] }}">{{ $recommend_new->category->name }}</h5>
                                        <h5>{{ $recommend_new->title }}</h5>
                                        <p class="news-datetime">{{ $recommend_new->created_at->format('F j, H:i') }}</p>
                                        <div class="small statistics-style">
                                            <span><i class="fa fa-eye"></i>{{ $recommend_new->views }}</span>
                                            <span><i class="fa fa-comment"></i>{{ $recommend_new->comments_count() }}</span>
                                        </div>
                                    </a>
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
    <script type="text/javascript">

        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getPosts(page);
                }
            }
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                getPosts($(this).attr('href').split('page=')[1]);
            });
        });

        $('#advanced_search_form').submit( function (event) {
            event.preventDefault();

            var search_text = $('#search_text').val();
            var search_category = $('#search_category').val();
            var search_date = $('#search_date').val();
            if(search_date=='')
                search_date = null;
            //console.log('Text: '+search_text);
            //console.log('Category: '+search_category);
            //console.log('Date: '+search_date);

            $.post("{{ url('/search') }}", {
                text : search_text,
                category : search_category,
                date : search_date
            }).done( function (data) {
                console.log(data);
                $('#news_items').html(data);
            });
        });

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
    </script>
@endsection
