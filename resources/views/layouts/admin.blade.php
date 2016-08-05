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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/sweetalert.css') }}">
</head>

<body class="fixed-navbar fixed-sidebar">
    <!-- Header -->
    <div id="header">
        <div id="logo">
            <img class="img-responsive" src="{{ URL::asset('img/new_logo_sm.png') }}">
        </div>

        <nav role="navigation">
            <div class="header-link hide-menu">
                <i class="fa fa-bars"></i>
            </div>
            <div class="small-logo">
                <img class="img-responsive" src="{{ URL::asset('img/new_logo_sm.png') }}">
            </div>

            <div id="form-search" class="col-sm-5 col-md-5 col-lg-5 p-xs">
                <form class="" action="{{ url('/admin/new/search') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group no-margin">
                        <input type="text" placeholder="Жаңалық іздеу..." class="form-control" name="search">
                    </div>
                </form>
            </div>

            <!-- Mobile menu -->
            <div class="mobile-menu">
                <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="collapse mobile-navbar" id="mobile-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="" href="{{ url('/admin/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Navbar right -->
            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu hdropdown notification animated flipInX">
                            <li>
                                <a>
                                    <span class="label label-success">NEW</span>It is a long established
                                </a>
                            </li>
                            <li class="summary"><a href="#">See all notification</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                        </a>
                        <ul class="dropdown-menu hdropdown bigmenu animated flipInX">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">
                                                <i class="fa fa-envelope"></i>
                                                <h5>Email</h5>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="{{ url('/admin/logout') }}">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End Header -->

    <!-- Navigation -->
    <aside id="menu">
        <div id="navigation">
            <div class="profile-picture">
                <a href="{{ url('/admin/profile') }}">
                    <img src="{{ URL::asset(Auth::guard('admin')->user()->avatar) }}" class="img-circle m-b" alt="Profile image">
                    <div class="stats-label text-color">
                        <span class="font-extra-bold font-uppercase">{{ Auth::guard('admin')->user()->name }}</span>
                        <small>{{ Auth::guard('admin')->user()->type }}</small>
                    </div>
                </a>
            </div>

            <ul class="nav" id="side-menu">
                <li class="">
                    <a href="{{ url('/admin') }}"><span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a role="button" aria-expanded="false"><span class="nav-label">Жаңалықтар</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('/admin/news') }}">Жаңалықтар тізімі</a></li>
                        <li><a href="{{ url('/admin/new/add') }}">Жаңалық қосу</a></li>
                        <li><a href="{{ url('/admin/new/search') }}">Іздеу</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/admins') }}"> <span class="nav-label">Админдер</span></a>
                </li>
                <li>
                    <a href="{{ url('/admin/categories') }}"> <span class="nav-label">Санаттар</span></a>
                </li>
                <li>
                    <a href="{{ url('/admin/posts') }}"> <span class="nav-label">Жолдамалар</span></a>
                </li>
                <li>
                    <a href="{{ url('/admin/comments') }}"> <span class="nav-label">Пікірлер</span></a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- End Navigation -->

    <!-- Main Wrapper -->
    <div id="wrapper">
        <div class="content animate-panel">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <span class="pull-right">
                Example text
            </span>
            Company 2015-2020
        </footer>
        <!-- End Footer -->
    </div>
    <!-- End Wrapper -->

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script rel="script" type="text/javascript" src="{{ URL::asset('js/homer.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>
    @yield('script')
</body>
</html>