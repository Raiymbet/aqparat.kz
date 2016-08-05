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
                                <span>Жаңалық іздеу</span>
                            </li>
                        </ol>
                    </div>
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
                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/GetArticleImage.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/news_events.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left clear-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/GetArticleImage.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/news_events.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-heart"></i>128</span>
                                    <span><i class="fa fa-share-alt"></i>12</span><br>
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>
                        </div>
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
    <script type="text/javascript">
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
    </script>
@endsection
