<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Aqparat.kz</title>

    <!-- CSS and Javascript -->
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif:700,400&subset=cyrillic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,cyrillic' rel='stylesheet'
          type='text/css'>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

<!-----Including CSS for different screen sizes----->
    @yield('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsivestyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
<!--<link rel="stylesheet" media="screen and (max-width: 1200px) and (min-width: 601px)"
          href="{{ URL::asset('css/responsivestyle1.css') }}"/>
    <link rel="stylesheet" media="screen and (max-width: 600px) and (min-width: 351px)"
          href="{{ URL::asset('css/responsivestyle2.css') }}"/>
    <link rel="stylesheet" media="screen and (max-width: 350px)" href="{{ URL::asset('css/responsivestyle3.css') }}"/>-->
</head>

<body id="app-layout" class="fixed-navbar blank">

<div id="header">
    <nav class="navbar no-margin">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header fixed-brand">
            <a class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <a href="{{ url('/') }}">
                <img class="img-responsive logo" src="{{ URL::asset('img/new_logo_sm.png') }}">
            </a>
        </div>
        <!-- navbar-header -->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <a class="header-link collapse in" data-toggle="collapse" id="menu-toggle-2">
                <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
            <!--<img class="menu-btn" src="{{ URL::asset('img/menu_btn.png') }}">-->
            </a>

            <div class="col-sm-5 col-md-5 padding-10">
                <form class="" action="{{ url('/search') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group no-margin">
                        <input type="text" placeholder="Жаңалық іздеу..." class="form-control" name="search">
                    </div>
                </form>
            </div>

            <div class="navbar-right">
                @if (Auth::guest())
                    <a class="header-link pull-right" href="{{ url('/login') }}">
                        <i class="fa fa-lg fa-sign-in"></i>
                    </a>
                @else
                    <a href="#" class="header-link" role="button">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <a href="#" class="dropdown-toggle header-link pull-right" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                @endif
            </div>
        </div>
        <!-- bs-example-navbar-collapse-1-->
    </nav>

    <div id="header-second">
        <div class="col-sidebar p-xs">
            <span id="datebox">Сенбі, Шілде 09, 2016</span>
        </div>
        <div class="col-lg-7" style="padding: 0">
            <nav role="navigation" class="">
                <ul class="list-unstyled list-inline" id="second-header-list">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            Columnists <i class="fa"><img class="img-responsive img-chevron"
                                                          src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($columnists as $columnist)
                                <li>
                                    <a href="{{ url('/columnist/'.$columnist->id) }}">{{ $columnist->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            On Point <i class="fa "><img class="img-responsive img-chevron"
                                                         src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                        </a>
                        <ul class="dropdown-menu" role="menubar">
                            <li><a href="#">Points</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Focus <i class="fa"><img class="img-responsive img-chevron"
                                                     src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Focuses</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}">Біз туралы <i class="fa"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3 p-xs text-right">
            <span class="">USD: 456</span>
            <span class="m-l-sm">EUR: 659</span>
            <span class="m-l-sm">RUB: 5.4</span>
        <span class="m-l-sm">
            <a href="#" role="button">Алматы +25 C <i class="fa"><img class="img-responsive img-chevron"
                                                                      src="{{ URL::asset('img/chevron_down_red.png') }}"></i></a>
        </span>
        </div>
    </div>
</div>

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

            <li class="active">
                <a href="{{ url('/') }}">
                        <span class="fa-stack fa-lg pull-left">
                            <i class="fa fa-newspaper-o fa-stack-1x "></i>
                        </span>
                    Жаңалықтар
                </a>
                <!--<ul class="nav-pills nav-stacked" style="list-style-type:none;">
                    <li><a href="#">link1</a></li>
                    <li><a href="#">link2</a></li>
                </ul>-->
            </li>
            @foreach($categories as $category)
                <li>
                    <a href="{{ url('/categorynews/'.$category->id) }}">
                        @if($category->name == 'Әлем')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-globe fa-stack-1x"></i>
                            </span>
                        @elseif($category->name == 'Қазақстан')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-stack-1x">KZ</i>
                            </span>
                        @elseif($category->name == 'Саясат')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-balance-scale fa-stack-1x"></i>
                            </span>
                        @elseif($category->name == 'Экономика')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-money fa-stack-1x"></i>
                            </span>
                        @elseif($category->name == 'Қоғам')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-users fa-stack-1x"></i>
                            </span>
                        @elseif($category->name == 'Мәдениет')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-bank fa-stack-1x"></i>
                            </span>
                        @elseif($category->name == 'Спорт')
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-futbol-o fa-stack-1x"></i>
                            </span>
                        @else
                            <span class="fa-stack fa-lg pull-left">
                                <i class="fa fa-stack-1x">NEW</i>
                            </span>
                        @endif
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ url('/myposts') }}">
                        <span class="fa-stack fa-lg pull-left">
                            <i class="fa fa-paper-plane-o fa-stack-1x "></i>
                        </span>
                    Жолдамаларым
                </a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            @yield('content')
        </div>
        <!-- /#contentainer-fluid xyz -->
    </div>
    <!-- /#page-content-wrapper -->
    <footer class="footer">
        <span><i class="fa fa-copyright"></i>2016 Raiymbet Tukpetov</span>
        <p>Біздің әлеуметтік желілеріміз:
            <i class="fa fa-facebook-square fa-lg"></i>
            <i class="fa fa-twitter-square fa-lg"></i>
            <i class="fa fa-vk fa-lg"></i>
            <i class="fa fa-instagram fa-lg"></i>
        </p>
    </footer>
</div>
<!-- /#wrapper -->

<!-- JavaScripts -->
@yield('script')
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#menu-toggle-2").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });

    function initMenu() {
        $('#menu ul').hide();
        $('#menu ul').children('.current').parent().show();
        //$('#menu ul:first').show();
        $('#menu li a').click(
                function () {
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        return false;
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#menu ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                        return false;
                    }
                }
        );
    }

    function getDate() {
        tday = ["Жексенбі", "Дүйсенбі", "Сейсенбі", "Сәрсенбі", "Бейсенбі", "Жұма", "Сенбі"];
        tmonth = ["Қаңтар", "Ақпан", "Наурыз", "Сәуір", "Мамыр", "Маусым", "Шілде", "Тамыз", "Қыркүйек", "Қазан", "Қараша", "Желтоқсан"];

        var d = new Date();
        var nday = d.getDay(),
                nmonth = d.getMonth(),
                ndate = d.getDate(),
                nyear = d.getYear();
        if (nyear < 1000) nyear += 1900;

        document.getElementById('datebox').innerHTML = "" + tday[nday] + ", " + tmonth[nmonth] + " " + ndate + ", " + nyear;

    }

    $(document).ready(function () {
        initMenu();
        getDate();
        $.get('{{ url('/currency') }}', function(data) {
            console.log(data);
        });
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>