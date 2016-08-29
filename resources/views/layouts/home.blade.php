<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Aqparat.kz</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('img/title_logo.png') }}" />

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
</head>

<body id="app-layout" class="fixed-navbar blank">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-one">
    <div class="row header-row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <span id="datebox" style=""></span>
            <div class="pull-right">
                @if (Auth::guest())
                    <a class="pull-right" href="{{ url('/login') }}">
                        LOG IN
                    </a>
                @else
                    <a href="#" class="" role="button">
                        <i class="fa fa-bell-o"></i>
                    </a>
                    <a href="#" class="dropdown-toggle pull-right m-l-md" data-toggle="dropdown"
                       role="button" aria-expanded="false">
                        <img class="img-responsive" style="width: 20px; height: 20px; float: left;" src="{{ Auth::user()->avatar}}">
                        <span class="m-l-sm">{{ Auth::user()->name }}</span>
                        <i class="fa ">
                            <img class="img-responsive img-chevron" src="{{ URL::asset('img/chevron_down_white.png') }}">
                        </i>
                    </a>
                    <ul class="dropdown-menu" role="menubar">
                        <li><a href="{{ url('/profile') }}">Profile</a></li>
                        <li><a href="{{ url('/comments') }}">My comments</a></li>
                        <li><a href="{{ url('/myposts') }}">My posts</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Logout</a></li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two" id="header-for-lg-md-screens">
    <div class="row header-row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-4 col-md-4 col-sm-3">
                <div class="m-t-lg" id="header-social-links">
                    <a href="#" style="color: #FFFFFF">
                        <i class="fa fa-facebook-square fa-lg fa-2x"></i>
                    </a>
                    <a href="#" style="color: #FFFFFF">
                        <i class="fa fa-twitter-square fa-lg fa-2x m-l-sm"></i>
                    </a>
                    <a href="#" style="color: #FFFFFF">
                        <i class="fa fa-linkedin-square fa-lg fa-2x m-l-sm"></i>
                    </a>
                    <a href="#" style="color: #FFFFFF">
                        <i class="fa fa-google-plus-square fa-lg fa-2x m-l-sm"></i>
                    </a>
                    <a href="#" style="color: #FFFFFF">
                        <i class="fa fa-rss-square fa-lg fa-2x m-l-sm"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 p-sm">
                <a href="{{ url('/') }}">
                    <img class="img-responsive" src="{{ asset('img/new_logo_word.png') }}" style="margin: auto auto;">
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-3">
                <div class="m-t-lg pull-right">
                    <a id="btn-search" class="" href="#" role="button" onclick="searchDisplay()" style="color: #FFFFFF">
                        <span class="fa-stack">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-search fa-stack-1x"></i>
                        </span>
                    </a>
                </div>
                <form id="form-search" class="hidden" action="{{ url('/search') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group no-margin">
                        <input id="input-search" type="text" placeholder="Жаңалық іздеу..." class="form-control" name="search"
                         style="position: absolute; margin-top: 30px; width: 90%; float: right;">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12">
                <nav role="navigation">
                    <ul class="list-unstyled list-inline" id="second-header-list">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                Бөлімдер <i class="fa"><img class="img-responsive img-chevron"
                                                              src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                            </a>
                            <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ url('/categorynews/'.$category->id) }}" role="button">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                Columnists <i class="fa"><img class="img-responsive img-chevron"
                                                              src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                            </a>
                            <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                                @foreach($columnists as $columnist)
                                    <li>
                                        <a href="{{ url('/columnist/'.$columnist->id) }}" role="button">{{ $columnist->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Round Table <i class="fa "><img class="img-responsive img-chevron"
                                                             src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                            </a>
                            <ul class="dropdown-menu list-unstyled list-inline" role="menubar">
                                @foreach($round_tables as $category)
                                    <li>
                                        <a href="{{ url('/roundtable/'.$category->id) }}" role="button">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Focus <i class="fa"><img class="img-responsive img-chevron"
                                                         src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                            </a>
                            <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                                @foreach($onfocus as $category)
                                    <li>
                                        <a href="{{ url('/onfocus/'.$category->id) }}" role="button">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}">Біз туралы <i class="fa"></i></a>
                        </li>
                        <li>
                            <a href="{{ url('/contactus') }}">Байланыс</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- MOBILE HEADER -->
<div class="col-xs-12 header-two" id="header-for-mobile-screens">
    <div class="row header-row">
        <a role="button" class="header-link pull-right" data-toggle="collapse" data-target="#mobile-collapse-second">
            <i class="fa">
                <img class="img-responsive img-chevron" src="{{ URL::asset('img/chevron_down_red.png') }}">
            </i>
        </a>
        <div class="mobile-navbar collapse" id="mobile-collapse-second">
            <ul class="nav navbar-nav">
                <li>
                    <form id="" class="" action="{{ url('/search') }}" method="GET">
                        {{ csrf_field() }}
                        <div class="form-group no-margin">
                            <input type="text" placeholder="Жаңалық іздеу..." class="form-control" name="search">
                        </div>
                    </form>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                        Бөлімдер <i class="fa"><img class="img-responsive img-chevron"
                                                    src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ url('/categorynews/'.$category->id) }}" role="button">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                        Columnists <i class="fa"><img class="img-responsive img-chevron"
                                                      src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($columnists as $columnist)
                            <li>
                                <a href="{{ url('/columnist/'.$columnist->id) }}" role="button">{{ $columnist->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Round Table <i class="fa "><img class="img-responsive img-chevron"
                                                        src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                    </a>
                    <ul class="dropdown-menu" role="menubar">
                        @foreach($round_tables as $category)
                            <li>
                                <a href="{{ url('/roundtable/'.$category->id) }}" role="button">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Focus <i class="fa"><img class="img-responsive img-chevron"
                                                 src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($onfocus as $category)
                            <li>
                                <a href="{{ url('/onfocus/'.$category->id) }}" role="button">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/about') }}">Біз туралы <i class="fa"></i></a>
                </li>
                <li>
                    <a href="{{ url('/contactus') }}">Байланыс</a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/login') }}">
                            LOG IN
                        </a>
                    </li>
                @else
                    <li><a href="{{ url('/profile') }}">Profile</a></li>
                    <li><a href="{{ url('/comments') }}">My comments</a></li>
                    <li><a href="{{ url('/myposts') }}">My posts</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
        <!--
        <a href="#" class="dropdown-toggle pull-right m-l-md" data-toggle="dropdown"
           role="button" aria-expanded="false">
            <i class="fa ">
                <img class="img-responsive img-chevron" src="{{ URL::asset('img/chevron_down_red.png') }}">
            </i>
        </a>
        <ul class="dropdown-menu" role="menubar" style="width: 100%;">
            <li>
                <form id="" class="" action="{{ url('/search') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group no-margin">
                        <input type="text" placeholder="Жаңалық іздеу..." class="form-control" name="search">
                    </div>
                </form>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                    Бөлімдер <i class="fa"><img class="img-responsive img-chevron"
                                                src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                </a>
                <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ url('/categorynews/'.$category->id) }}" role="button">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                    Columnists <i class="fa"><img class="img-responsive img-chevron"
                                                  src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                </a>
                <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                    @foreach($columnists as $columnist)
                        <li>
                            <a href="{{ url('/columnist/'.$columnist->id) }}" role="button">{{ $columnist->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Round Table <i class="fa "><img class="img-responsive img-chevron"
                                                    src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                </a>
                <ul class="dropdown-menu list-unstyled list-inline" role="menubar">
                    @foreach($round_tables as $category)
                        <li>
                            <a href="{{ url('/roundtable/'.$category->id) }}" role="button">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Focus <i class="fa"><img class="img-responsive img-chevron"
                                             src="{{ URL::asset('img/chevron_down_white.png') }}"></i>
                </a>
                <ul class="dropdown-menu list-unstyled list-inline" role="menu">
                    @foreach($onfocus as $category)
                        <li>
                            <a href="{{ url('/onfocus/'.$category->id) }}" role="button">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{ url('/about') }}">Біз туралы <i class="fa"></i></a>
            </li>
            <li>
                <a href="{{ url('/contactus') }}">Байланыс</a>
            </li>
            <li>
                <a href="#"></a>
            </li>
            @if (Auth::guest())
                <li>
                    <a href="{{ url('/login') }}">
                        LOG IN
                    </a>
                </li>
            @else
                <li><a href="{{ url('/profile') }}">Profile</a></li>
                <li><a href="{{ url('/comments') }}">My comments</a></li>
                <li><a href="{{ url('/myposts') }}">My posts</a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            @endif
        </ul>
        -->
    </div>
</div>

@yield('content')

<div style="">
    <!-- Page Content -->
    <div id="">
        <div class="container-fluid xyz">

        </div>
        <!-- /#contentainer-fluid xyz -->
    </div>
    <!-- /#page-content-wrapper -->
    <footer class="footer">
        <div class="footer-content">
            <span><i class="fa fa-copyright"></i>2016 Aqparat.kz</span>
            <br>
            <p>Әлеуметтік желілеріміз:
                <a href="#">
                    <i class="fa fa-facebook-square fa-lg m-l-xs"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter-square fa-lg m-l-xs"></i>
                </a>
                <a href="#">
                    <i class="fa fa-linkedin-square fa-lg m-l-xs"></i>
                </a>
                <a href="#">
                    <i class="fa fa-google-plus-square fa-lg m-l-xs"></i>
                </a>
                <a href="#">
                    <i class="fa fa-rss-square fa-lg m-l-xs"></i>
                </a>
            </p>
        </div>
    </footer>
</div>
<!-- /#wrapper -->

<!-- JavaScripts -->
@yield('script')
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    //$("#menu-toggle-2").click(function (e) {
       // e.preventDefault();
       // $("#wrapper").toggleClass("toggled-2");
       // $('#menu ul').hide();
    //});

    /*
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
    */

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

    function searchDisplay(){
        $('#form-search').removeClass('hidden');
        $('#input-search').focus();
        $('#btn-search').hide();
    }

    $(document).ready(function () {
        //initMenu();
        getDate();
        $.get('{{ url('/currency') }}', function(data) {
            console.log(data);
        });
        $('#input-search').focusout(function() {
            $('#form-search').addClass('hidden');
            $('#btn-search').show();
        });
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>