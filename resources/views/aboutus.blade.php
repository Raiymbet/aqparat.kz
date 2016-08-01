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
                                <span>Біз туралы</span>
                            </li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <h6>What we do</h6>
                        <p>Our commentaries appear in
                        476 media outlets
                        in 154 countries
                        Project Syndicate produces and delivers original, high-quality commentaries to a global audience. Featuring exclusive contributions by prominent political leaders, policymakers, scholars, business leaders, and civic activists from around the world, we provide news media and their readers cutting-edge analysis and insight, regardless of ability to pay. Our membership now includes nearly 500 media outlets – more than half of which receive our commentaries for free or at subsidized rates – in more than 150 countries.
                        </p>
                        <h6 class="m-t">Why we do it</h6>
                        <p>
                        Project Syndicate began in the early 1990s as an initiative to assist newly independent media in post-communist Central and Eastern Europe, before quickly expanding to Western Europe, Africa, Asia, and the Americas. Our rapid growth has been guided by a simple credo: All people – wherever they live, whatever their income, and whatever language they use – deserve equal access to a broad range of views by the world’s foremost leaders and thinkers on the issues, events, and forces shaping their lives.
                        Our contributors include
                        45 Nobel laureates
                        and 111 heads of state
                        Project Syndicate thus provides an invaluable global public good: ensuring that news media in all countries, regardless of their financial and journalistic resources – and often in challenging political environments – can offer readers original, engaging, and thought-provoking analysis by the world’s leading innovators in economics, politics, health, technology, and culture. Indeed, without Project Syndicate, most of the publications we serve would be unable to secure comparable commentaries.
                        </p>
                        <h6 class="m-t">How we do it</h6>
                        <p>
                        News organizations in developed countries provide financial contributions for the rights to Project Syndicate commentaries, which enables us to offer these rights for free, or at subsidized rates, to newspapers and other media in the developing world. Because no publication is turned down solely on the basis of its inability to pay, Project Syndicate has cultivated strong partnerships with the most respected news media in every country in which it operates. This, in turn, has made Project Syndicate an even more attractive outlet for the world’s most eminent authors, for whom a truly global audience simply is not available elsewhere.
                        Indeed, because our highest priority is to disseminate authors’ commentaries as widely as possible, we provide translations free of charge, enabling editors worldwide to publish them simultaneously. We currently translate authors’ commentaries from English into 12 languages (Arabic, Bahasa Indonesia, Czech, Dutch, French, German, Hindi, Italian, Mandarin, Portuguese, Russian, and Spanish). Member publications translate into 50 additional languages.
                        </p>
                        <h6 class="m-t">How you can help</h6>
                        <p>
                            Ultimately, the backbone of Project Syndicate is readers like you: informed, engaged citizens around the world who appreciate the value of open, civil, high-level debate about issues of global concern. It is readers like you who strive to advance the common good by seeking cooperative solutions to collective problems. And, as the decline of print publication erodes news organizations’ traditional revenue models, it is readers like you who must help us ensure that all people, regardless of where they live or their ability to pay, continue to benefit from the insights and analysis that only Project Syndicate provides.
                        </p>

                        <h6 class="m-t-lg">
                            Testimonials
                        </h6>
                        <p>
                            <span class="quote">“'Generosity gives assistance, rather than advice,' wrote a French moralist in the middle of the eighteenth century. It seems his reflection still holds today. However, looking at the things Project Syndicate has done for so many years for so many media all over this imperfect world, one is tempted to say that both parts of Vauvenargues' maxim are true. Who else offers so many different views and opinions of the most eminent thinkers, experts, and policy-makers about the most...</span>
                            <br>
                            <p class="text-right">
                                <strong>Radomir Ličina</strong>
                                <br>
                                Senior Editor, Danas, Serbia
                            </p>
                        </p>
                        <p>
                            <span class="quote">“Project Syndicate’s commentaries and analyses have proved extremely useful to Ta Nea, especially over the last few difficult years. Most important, they have allowed us to offer our readers a variety of international perspectives and insightful points of view on the unfolding crisis in Greece and the Eurozone. No other syndication service offers such a spectrum of high-quality views. We look forward to continuing our fruitful relationship with Project Syndicate, and thank...</span>
                            <br>
                            <p class="pull-right text-right">
                                <strong>Dimitris Mitropoulos</strong>
                                <br>
                                Editor, Ta Nea, Greece
                            </p>
                        </p>
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
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection