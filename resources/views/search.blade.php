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
                        <form class="form-horizontal" action="" method="POST">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Жаңалықты іздеу...">
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
                                    <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Санаты:</label>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="new_category">
                                            <option selected="">Барлығы</option>
                                            <option>Қазақстан</option>
                                            <option>Әлем</option>
                                            <option>Саясат</option>
                                            <option>Экономика</option>
                                            <option>Қоғам</option>
                                            <option>Мәдениет</option>
                                            <option>Спорт</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label">Уақыты:</label>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <input type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div id="news-items">
                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-red"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Әлем</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Қазақстан</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Саясат</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Экономика</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Мәдениет</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Қоғам</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <h4 class="text-green"><small>21.03.2016, 18:45</small></h4>
                                <h4>Астанадағы "қайырымды автобус" Желі қолданушыларын тәнті етті</h4>
                                <p>Желі қолданушысы Нұрсерік Жолбарыс өз парақшасында осы оқиғаның видеосын жария етті. Айтуынша,...</p>
                                <div class="text-left text-green">
                                    <span>Спорт</span>
                                </div>
                                <div class="small statistics-style">
                                    <span>Көрілген <i class="fa fa-eye fa-lg"></i> 123</span>
                                    <span class="margin-left-20">Пікірлер <i class="fa fa-comment fa-lg"></i> 5</span>
                                    <span  class="margin-left-20">Ұнатамын <i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                                    <span class="margin-left-20">Бөлісу <i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="hpanel filter-item-last">
                    <a href="#" class="btn btn-info btn-block">Тағы жүктеу</a>
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

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="hpanel hblue">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Соңғы жаңалықтар</h6>
                    </div>
                    <div class="panel-body" style="overflow-x: scroll">
                        <div id="last-news">
                            <ul class="list-unstyled" id="last-news-list">
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>

                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>

                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="hpanel hgreen">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Көп оқылғандар</h6>
                    </div>
                    <div class="panel-body panel-scrollbar">
                        <div id="more-reads-news">
                            <ul class="list-unstyled" id="more-reads-news-list">
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>

                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>

                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                                <li>
                                    <span class="news-datetime">Шілде 01, 09:45</span>
                                    <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="hpanel horange">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Жолдамалар</h6>
                    </div>
                    <div class="panel-body" style="overflow-y: scroll;">
                        <ul class="list-unstyled" id="posts-list">
                            <li>
                                <span><i class="fa fa-pencil-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-check-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-check-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-ban fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-check-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
                            <li>
                                <span><i class="fa fa-check-square-o fa-lg"></i></span>
                                <span class="news-datetime">Шілде 01, 09:45</span>
                                <p>Террористы планировали захват заложников в аэропорту Стамбула - СМИ</p>
                            </li>
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
