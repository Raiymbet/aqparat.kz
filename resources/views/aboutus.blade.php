@extends('layouts.home')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flag-icon.css') }}">
    <title>Aqparat.kz туралы мәлімет</title>
@endsection

@section('content')

    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs"><strong>Біз туралы</strong></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="hpanel blog-article-box">
                        <div class="panel-body">
                            <div class="col-lg-12">

                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="selected-language">
                                        <i class="flag-icon flag-icon-kz"></i>
                                        <span>Kazakh</span>
                                    </span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" id="language-dropdown">
                                        <li>
                                            <button type="button" class="btn btn-default btn-block" onclick="getTranslate('kz')">
                                            <span id="language-kz">
                                                <i class="flag-icon flag-icon-kz"></i>
                                                <span>Kazakh</span>
                                            </span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-default btn-block" onclick="getTranslate('')">
                                             <span id="language-ru">
                                                 <i class="flag-icon flag-icon-ru"></i>
                                                 <span>Russian</span>
                                             </span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-default btn-block" onclick="getTranslate()">
                                            <span id="language-en">
                                                <i class="flag-icon flag-icon-gb"></i>
                                                <span>English</span>
                                            </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <h3 class="about-header" >Біздің мақсат</h3>
                            <p>Еліміз бен әлемде болып жатқан түрлі оқиаларды дер кезінде, сапалы және өзіндік
                                стилде Қазақстандық һәм шетелдік аудиторияға ұсыну.  Біз Қазақстандық және шетелдік
                                саяси тұлғалардан, саясаткерлерден, бизнес лидерлерден сондай-ақ, азаматтық
                                ұстанымы айқын белсенді азаматтардан алынған экслюзивті материалдарды оқуға
                                мүмкіндік береміз. Біздің ұжым 15 тәжірибелі маманнан және мыңдаған AQPARAT-ты
                                белсенді қолданушылардан тұрады.
                            </p>

                            <h3 class="about-header" style="margin-top: 20px;">Не үшін жасаймыз</h3>
                            <p>1991 КСРО ыдырағаннан кейін тәуелсіз мемлекеттердің өзіндік демократиялық даму бағыты
                                мен ақпарттық саясаты қалыптасты. Әлемге әсер еткен бұл жаңа саяси өзгеріс жаһандық
                                саяси аренада   жаңа мүдделер қақтығысын тудырды.  Бұл мүдделер тартысы тек Орталық
                                Азия емес, Шығыс Еуропа, Орталық Еуропа, Африка, Америка, Шығыс  елдеріне де тікелей
                                ықпал етті. Авторитарлық режимге бейімдеу Посткоммунистік сана жаңа әлемдік
                                талаптарға жауап беру үшін мемлекеттің саяси иерархиялық құрылымын сондай-ақ,
                                ішкі және сыртқы саясатты либералдық талапқа сай қайта құру мұқтаждығы сезілуде.
                                Осы арада қоғам мен зиялы қауым арасында, билік пен халық арасындағы медиалық
                                байланыс өте маңызды рөл ойнайтыны белгілі. Олай болса, AQPARAT осы байланысты
                                орнатуға әзір.
                            </p>
                            <h3 class="about-header" style="margin-top: 20px;">Біз ақпартты қалай жасаймыз</h3>
                            <p>AQPARAT контентті қазақ, орыс және ағылшын тілдерінде ұсынады.<br>
                            Кез келген заманауи медиа құралдары секілді AQPARAT қызметкерлері де, болған
                                оқиғаны суреттеу, бейнелеу және жазу арқылы аудиторияға ұсынады. Сонымен қатар,
                                AQPARAT жүйесіне тіркелген білікті мамандардың саяси құбылысқа берген бағалары мен
                                комментарилерін оқи аласыздар. Fact checking мен сенімді ақпарат біздің негізгі
                                құралымыз. Аудиториядан келген хабарламалар да AQPARAT-тың негізгі дерек көзі болып
                                қалмақ. Сапалы контент ұсынуда Storytelling, инфографика сынды жаңа жанрлар да
                                назарымыздан тыс қалмайды. Автордың идеясы мен көз қарасын қазақ, орыс және ағылшын
                                тілді кең аудиторияға жеткізу AQPARAT-тың басты приоритеті .
                            </p>
                            <h3 class="about-header" style="margin-top: 20px;">Сіз қалай көмектесе аласыз</h3>
                            <p>Елімізде және шетеледе болып жатқан саяси, әлеуметтік оқиғаларға, экономикалық
                                құбылыстарға бей-жай қарамай, пікірін ашық білдіріп, жоғары деңгейлі дискуссия
                                жүргізуге дайын сіз сияқты көзі ашық, көкірегі ояу белсенді азаматтар - AQPARAT-тың
                                бел омыртқасы. Сондай-ақ, бұл оқырмандар отандық және ғаламдық проблемаларды шешу
                                үшін игі бастамаларға ұмтылған
                            </p>
                        </div>
                    </div>

                </div>

                <div id="jarnama" class="col-xs-12 col-sm-6 col-md-3 col-lg-3 pull-right p-r-xs">
                    <!-- Jarnama ushin arnalgan oryn -->
                    <div class="">
                        <img src="{{ asset('img/adsense.png') }}" class="img-responsive" style="height: 368px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        function getTranslate(language){
            $.get('{{ url('/newsread/translate') }}'+'/'+id, function(data) {
                //console.log(data);
                $('#new_title').html(data.title);
                $('#new_text').html(data.text);
                var selected_content = $('#language-'+language).html();
                $('#selected-language').html(selected_content);
                $('#print').attr('href', '{{url('/print')}}'+'/'+id);
            });
        }
    </script>
@endsection