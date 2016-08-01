@extends('layouts.home')


@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="hpanel blog-article-box">
                    <div class="panel-heading hbuilt">
                        <ol class="hbreadcrumb breadcrumb">
                            <li><a href="#">Негізгі бет</a></li>
                            <li class="active">
                                <span>Жаңалықтар</span>
                            </li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <select id="select_translate" class="pull-right">
                                <option value="{{ $new->id }}" selected>{{ $new->language }}</option>
                                @foreach($translates as $translate)
                                    <option value="{!! $translate->news->id !!}">{!! $translate->news->language !!}</option>
                                @endforeach
                            </select>
                            <h3 id="new_title">{{ $new->title }}</h3>
                        </div>
                        <div id="new_text_content">
                            <br>
                            @if(!is_null($new->avatar_picture))
                                <img class="img-responsive" src="{{ URL::asset($new->avatar_picture) }}" alt="News">
                            @endif
                            <br>
                            <span id="new_text">{!! $new->text !!}</span>
                            <br>
                            <span class="pull-right">
                                <p id="new_author">
                                    <small>
                                        <strong>Авторы: </strong> <a href="#">{{ \App\Admin::find($new->author_id)->name }}</a>
                                        <br>
                                        <strong>Күні: </strong>{{ $new->created_at }}
                                    </small>
                                </p>
                            </span>
                        </div>
                    </div>
                    <div class="panel-body panel-statistics text-muted">
                        <div class="row">
                            <div class="pull-right">
                                <span><i class="fa fa-eye fa-lg"></i> {{ $new->views }}</span>
                                <span class="margin-left-20"><a href="#comments"><i class="fa fa-comment fa-lg"></i> {{ $new->comments_count() }}</a></span>
                                <span  class="margin-left-20"><i role="button" class="fa fa-heart fa-lg"></i> {{ $new->likes }}</span>
                                <span class="margin-left-20"><i role="button" class="fa fa-share-alt fa-lg"></i> {{ $new->shares }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($comments) > 0)
                    <div id="comments" class="hpanel forum-box">
                        <div class="panel-heading hbuilt">
                            <h6>Пікірлер ({{ $new->comments_count() }}) </h6>
                        </div>
                        @foreach($comments as $comment)
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-image pull-left">
                                        <img src="{{ isset($comment->user->avatar)?$comment->user->avatar:url('img/default_user.png')  }}" alt="Қолданушы суреті">
                                        <div class="author-info">
                                            <strong>{{ $comment->user->name }}</strong>
                                            <br>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>

                                    <div class="media-body">
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="hpanel">
                    <div class="panel-heading hbuilt">
                        <h6>Пікір жазу</h6>
                    </div>
                    <div class="panel-body">
                        <div class="row-with-padding" style="">
                            <form id="comment_form" class="form-horizontal">
                                <div class="form-group">
                                    <textarea class="form-control textarea-infocus" id="comment-textarea" placeholder="Пікіріңізді осында жазыңыз..." rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <p id="comment-result" class="text-info">Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз</p>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right">
                                            Жіберу
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

            <div id="jarnama" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="hpanel hred">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Жарнама</h6>
                    </div>
                    <div class="panel-body">
                        <p>Ақпараттандыру сайты туралы жарнамалар салуға болады</p>
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

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
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

            <div id="" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
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
    <!--
    <div class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="hpanel blog-article-box">
                    <div class="panel-heading hbuilt">
                        <ol class="hbreadcrumb breadcrumb">
                            <li><a href="#">Негізгі бет</a></li>
                            <li class="active">
                                <span>Жаңалықтар</span>
                            </li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <div class="">
                            <h3>Назарбаев: Мен президент болуды армандамадым<br>
                                <small><strong>Авторы және күні:</strong> Әділ Кенжебеков 21.03.2016, 18:45</small>
                            </h3>
                        </div>
                        <img class="img-responsive" src="{{ URL::asset('img/news.jpg') }}" alt="News">
                        <p>Қазақстан Президенті Нұрсұлтан Назарбаев бала кезінде президент болуды армандамаса да, әрқашан бірінші болғысы келгенін айтып берді, - деп хабарлайды Tengrinews.kz тілшісі.</p>
                        <p>Қазақстан Президенті Нұрсұлтан Назарбаев туралы деректі фильм "Хабар" телеарнасының эфирінде көрсетілді.</p>
                        <p> <span class="quote">"Президент болсаң, тағдырдың бұйрығы деуге болады. Мен балалық шағымда, жас кезімде, мектепте, университетте президент боламын деп ешқашан ойламадым. Бірақ мен қайда болсам да екінші болғым келмеді. Мектепте топ басы болдым (...)"</span>, - деп еске алды Назарбаев "Елбасы" фильмінде.</p>
                        <blockquote class="twitter-tweet" data-lang="ru"><p lang="ru" dir="ltr">От пассажиров рейса Москва - Стамбул скрыли истинную причину возвращения в Россию.<br><br>ВИДЕО: <a href="https://t.co/Ti4t1HWP4r">https://t.co/Ti4t1HWP4r</a> <a href="https://t.co/hkYnNZ43pq">pic.twitter.com/hkYnNZ43pq</a></p>&mdash; Вести.Ru (@vesti_news) <a href="https://twitter.com/vesti_news/status/754222264241926144">16 июля 2016 г.</a></blockquote>
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <p><span class="quote">"Мені тағайындағанда, әлі есімде, Мәскеуде Горбачев менен "Күш бар ма?" (...) деп сұрады. Бар, не боп қалды деймін ғой. Сөйтсем ол былай дейді: Алда үлкен жұмыс бар, күрес бар"</span>, - дейді Назарбаев.</p>
                        <p>Фильмде Нұрсұлтан Назарбаевтың 1986 жылы ақпанда ҚазКСР КП XXVI съезінде сөйлеген сөзі көрсетілді.</p>
                        <p><span class="quote">"Әрине, бұл сөзім бүлік болды, шынымды айтайын, бірақ айтпай тұра алмадым, маған қиын болды. Өте қатты құрметтейтін басшыма сөзімнің тиіп кетіп тұрғанын түсіндім. Бірақ мен оның жеке басына тимедім, экономика жайлы айттым. Бірақ мен оған қатты тиіп кететіні жайлы тіпті ойламадым да. Өз ішімде мен оған көмектесіп жатырмын деп есептедім. Мен ол бұл жайлы білмейді деп ойладым. Мен жас болып келдім, Қазақстан экономикасындағы барлық шалалықты Қонаевқа баяндадым. Дербестік, тәуелсіздік көрінді"</span>, - дейді фильмде Назарбаев</p>
                        <p>90-жылдар көрсетілді. <span class="quote">"Қаладым ба, жоқ па, мені бірінші президент етіп сайлады. Мен өз үміткерлігімді алып тастаған жоқпын ғой, қарсы болмадым. Бұл қаладым деген сөз, жағымды болды. Алайда қорқыныш та болды. Күйреген ел. Кеңес одағы күйреді. Барлығы тұрақтап қалды. Экономика жұмыс істемейді, адамдардың алдында сөз сөйлеуің керек, ең бастысы - халықтың жағдайы жақсаруы үшін әрекет етуің керек. Сондай кезде іс қолымнан келе ме екен, ал мына істе бір сәті түсер, ал тағы бір жағдайда тағдырдың жазғанын көрерміз деп ойлайды екенсің"</span>, - деп еске алды Назарбаев.</p>
                    </div>
                    <div class="panel-body panel-statistics text-muted">
                        <div class="row">
                            <div class="pull-right">
                                <span><i class="fa fa-eye fa-lg"></i> 1287</span>
                                <span class="margin-left-20"><a href="#comments"><i class="fa fa-comment fa-lg"></i> 5</a></span>
                                <span class="margin-left-20"><i role="button" class="fa fa-share-alt fa-lg"></i> 12</span>
                                <span  class="margin-left-20"><i role="button" class="fa fa-heart fa-lg"></i> 23</span>
                            </div>
                        </div>
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

                <div id="comments" class="hpanel forum-box">
                    <div class="panel-heading hbuilt">
                        <h6>Пікірлер (5) </h6>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-image pull-left">
                                <img src="{{ URL::asset('img/default_user.png') }}" alt="Қолданушы суреті">
                                <div class="author-info">
                                    <strong>Анна Смит</strong>
                                    <br>
                                    Сәуір 12, 2016
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Vivamus luctus diam et magna</h5>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                                even slightly believable.
                                Ut mollis mauris in quam scelerisque, nec euismod nulla rutrum. Vestibulum elementum porta pharetra. Praesent volutpat, mi sed laoreet facilisis, turpis erat ornare orci, a
                                faucibus sapien eros quis nibh.
                                <br>
                                <br>
                                Praesent tempus nunc in libero lacinia, nec auctor arcu commodo. Sed sagittis interdum varius. Cras quis ex dictum, laoreet enim quis, aliquam
                                odio. Nunc ac risus ex. Nunc tempor a ex nec malesuada. Suspendisse efficitur varius mollis.
                                <br>
                                <br>
                                Mauris tellus eros, faucibus vel fringilla sit amet, volutpat commodo erat. Nam fermentum tellus facilisis consectetur varius. Mauris et molestie leo. Cras mattis pellentesque massa, convallis accumsan dui sagittis vel.
                                <br>
                                <br>
                                <i>
                                    - Best regards, Anna Smith
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-image pull-left">
                                <img src="{{ URL::asset('img/default_user.png') }}" alt="Қолданушы суреті">
                                <div class="author-info">
                                    <strong>Анна Смит</strong>
                                    <br>
                                    Сәуір 12, 2016
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Vivamus luctus diam et magna</h5>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                                even slightly believable.
                                Ut mollis mauris in quam scelerisque, nec euismod nulla rutrum. Vestibulum elementum porta pharetra. Praesent volutpat, mi sed laoreet facilisis, turpis erat ornare orci, a
                                faucibus sapien eros quis nibh.
                                <br>
                                <br>
                                Praesent tempus nunc in libero lacinia, nec auctor arcu commodo. Sed sagittis interdum varius. Cras quis ex dictum, laoreet enim quis, aliquam
                                odio. Nunc ac risus ex. Nunc tempor a ex nec malesuada. Suspendisse efficitur varius mollis.
                                <br>
                                <br>
                                Mauris tellus eros, faucibus vel fringilla sit amet, volutpat commodo erat. Nam fermentum tellus facilisis consectetur varius. Mauris et molestie leo. Cras mattis pellentesque massa, convallis accumsan dui sagittis vel.
                                <br>
                                <br>
                                <i>
                                    - Best regards, Anna Smith
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-image pull-left">
                                <img src="{{ URL::asset('img/default_user.png') }}" alt="Қолданушы суреті">
                                <div class="author-info">
                                    <strong>Анна Смит</strong>
                                    <br>
                                    Сәуір 12, 2016
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Vivamus luctus diam et magna</h5>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                                even slightly believable.
                                Ut mollis mauris in quam scelerisque, nec euismod nulla rutrum. Vestibulum elementum porta pharetra. Praesent volutpat, mi sed laoreet facilisis, turpis erat ornare orci, a
                                faucibus sapien eros quis nibh.
                                <br>
                                <br>
                                Praesent tempus nunc in libero lacinia, nec auctor arcu commodo. Sed sagittis interdum varius. Cras quis ex dictum, laoreet enim quis, aliquam
                                odio. Nunc ac risus ex. Nunc tempor a ex nec malesuada. Suspendisse efficitur varius mollis.
                                <br>
                                <br>
                                Mauris tellus eros, faucibus vel fringilla sit amet, volutpat commodo erat. Nam fermentum tellus facilisis consectetur varius. Mauris et molestie leo. Cras mattis pellentesque massa, convallis accumsan dui sagittis vel.
                                <br>
                                <br>
                                <i>
                                    - Best regards, Anna Smith
                                </i>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-info btn-block">Тағы жүктеу</a>
                </div>

                <div class="hpanel">
                    <div class="panel-heading hbuilt">
                        <h6>Пікір жазу</h6>
                    </div>
                    <div class="panel-body">
                        <div class="row-with-padding" style="">
                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <textarea class="form-control textarea-infocus" id="comment-textarea" placeholder="Пікіріңізді осында жазыңыз..." rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <p>Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <button type="submit" class="btn btn-info pull-right">
                                                Жіберу
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

            <!--
            <div id="jarnama" class="col-xs-12 col-sm-12 col-md-6 col-lg-2">
                <div class="hpanel hred">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Жарнама</h6>
                    </div>
                    <div class="panel-body">
                        <p>Ақпараттандыру сайты туралы жарнамалар салуға болады</p>
                    </div>
                </div>
            </div>

            <div id="" class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="hpanel horange">
                    <div class="panel-heading hbuilt">
                        <h6 class="text-center">Жолдамалар</h6>
                    </div>
                    <div class="panel-body" style="overflow-x: scroll">
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
    -->
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script type="text/javascript">
        $('#select_translate').change( function () {
            //console.log($(this).val());
            $.get('{{ url('/newsread/translate') }}'+'/'+$(this).val(), function(data) {
                //console.log(data);
                $('#new_title').html(data.title);
                $('#new_text').html(data.text);
                if(data.language == 'ru'){
                    $('#new_author').html('<small><strong>Автор: </strong>'+'{{ \App\Admin::find($new->author_id)->name }}'+
                            '<br><strong>Дата: </strong>'+data.created_at+'</small>');
                }
                else if(data.language == 'kz'){
                    $('#new_author').html('<small>'+
                            '<strong>Авторы: </strong> <a href="#">{{ \App\Admin::find($new->author_id)->name }}</a>'+
                            '<br>'+
                            '<strong>Күні: </strong>{{ $new->created_at }}'+
                            '</small>');
                }else if(data.language == 'en'){
                    $('#new_author').html('<small>'+
                            '<strong>Author: </strong> <a href="#">{{ \App\Admin::find($new->author_id)->name }}</a>'+
                            '<br>'+
                            '<strong>Date: </strong>{{ $new->created_at }}'+
                            '</small>');
                }
            });
        });

        $('#comment_form').submit( function (event) {
            event.preventDefault();

            $comment = $('#comment-textarea').val();
            if($comment){
                @if(Auth::guest()){
                    window.location.replace('{{url('/login')}}');
                }@else
                    $.post("{{ url('/newsread/'.$new->id) }}", {
                        comment : $comment
                    }).done( function (data) {
                        $('#comment-textarea').val('');
                        $('#comment-result').removeClass().addClass('text-success').html(data);
                    console.log(data);
                    });
                @endif
            }else{
                $('#comment-result').removeClass().addClass('text-danger').html("Пікір енгізіңіз!");
            }
            //setTimeout(function() { $("#comment-result").removeClass().addClass('text-info').html('Жіберу түймесін басу арқылы, сіз пікір айту ережелеріне келісім бересіз'); }, 2000);
        });
    </script>
@endsection