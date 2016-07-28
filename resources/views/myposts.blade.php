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
                                <span>Жолдамаларым</span>
                            </li>
                        </ol>
                    </div>

                    <div class="panel-body">
                        <p>
                            <span>* <i class="fa fa-pencil-square-o fa-lg"></i></span> - Жолдама өңделу барысында. <br>
                            <span>* <i class="fa fa-square-o fa-lg"></i></span> - Жолдама өңделмеген. <br>
                            <span>* <i class="fa fa-check-square-o fa-lg"></i></span> - Жолдама өңделіп, расталған. <br>
                            <span>* <i class="fa fa-ban fa-lg"></i></span> - Жолдама өңделіп, расталмаған.
                        </p>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{url('/myposts/search')}}" method="POST">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="post" class="form-control" type="text" placeholder="Жолдаманы іздеу...">
                                        <div class="input-group-btn">
                                            <button class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Күйі:</label>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="status">
                                            <option value="all" selected="selected">Барлығы</option>
                                            <option value="">Өңделмеген</option>
                                            <option value="accepted">Расталған</option>
                                            <option value="baned">Расталмаған</option>
                                            <option value="processing">Өңделуде</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Уақыты:</label>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <input name="datetime" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="hpanel">
                    @if(!count($posts)>0)
                        <div class="panel-body" style="min-height: 300px;">
                            <p class="text-info">Сізде жолданған хабрламаларыңыз жоқ.</p>
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h5>
                                        <span>
                                        @if($post->status == null)
                                            <i class="fa fa-square-o fa-lg"></i>
                                        @elseif($post->status == 'accepted')
                                            <i class="fa fa-check-square-o fa-lg"></i>
                                        @elseif($post->status == 'baned')
                                            <i class="fa fa-ban fa-lg"></i>
                                        @elseif($post->status == 'processing')
                                            <i class="fa fa-pencil-square-o fa-lg"></i>
                                        @endif
                                        </span>
                                        {{ $post->created_at }}
                                    </h5>
                                    <div>
                                        <p>{{ $post->text }}</p>
                                        @if($post->news_id != null)
                                            <a href="{{ url('/news/'.$post->news_id) }}">Мақаланы оқу...</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($post->status == 'baned')
                                <div class="row">
                                    <div class="col-sm-12 m-t-md">
                                        <div class="btn-group pull-right">
                                            <form action="{{url('/myposts/' . $post->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-sm btn-default"> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <!--
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h5><span><i class="fa fa-check-square-o fa-lg"></i></span> Маусым 01, 2016, 09:45</h5>
                                <div>
                                    <p>Комитеттің сайтында 6 маусым күні электронды ақпараттық ресурстарда Ақтөбедегі терактіні "Қазақстанды азат ету армиясы" деген ұйымның мойнына алғаны туралы хабардың тарағаны айтылады.</p>
                                    <a href="#">Мақаланы оқу...</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h5><span><i class="fa fa-pencil-square-o fa-lg"></i></span> Маусым 01, 2016, 09:45</h5>
                                <div>
                                    <p>Комитеттің сайтында 6 маусым күні электронды ақпараттық ресурстарда Ақтөбедегі терактіні "Қазақстанды азат ету армиясы" деген ұйымның мойнына алғаны туралы хабардың тарағаны айтылады.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h5><span><i class="fa fa-square-o fa-lg"></i></span> Маусым 01, 2016, 09:45</h5>
                                <div>
                                    <p>Комитеттің сайтында 6 маусым күні электронды ақпараттық ресурстарда Ақтөбедегі терактіні "Қазақстанды азат ету армиясы" деген ұйымның мойнына алғаны туралы хабардың тарағаны айтылады.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <h5><span><i class="fa fa-ban fa-lg"></i></span> Маусым 01, 2016, 09:45</h5>
                                <div>
                                    <p>Комитеттің сайтында 6 маусым күні электронды ақпараттық ресурстарда Ақтөбедегі терактіні "Қазақстанды азат ету армиясы" деген ұйымның мойнына алғаны туралы хабардың тарағаны айтылады.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
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
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/news_events.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left clear-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/GetArticleImage.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/news_events.jpg') }}">
                                <h5>Қытайда Ақжарқын Тұрлыбайдың ісіне қатысты тағы да сот отырысы өтеді</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 news-thumbnail text-justify pull-left">
                                <img class="img-responsive image-main-news" src="{{ URL::asset('img/newspaper.jpg') }}">
                                <h5>Назарбаев "Астана" көлік-логистика орталығына барды</h5>
                                <p class="news-datetime">September 10, 12:34</p>
                                <div class="small statistics-style">
                                    <span><i class="fa fa-eye"></i>1287</span>
                                    <span><i class="fa fa-comment"></i>5</span>
                                </div>
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
    <script type="text/javascript">

    </script>
@endsection