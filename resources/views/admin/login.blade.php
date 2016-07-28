<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsivestyle.css') }}">
</head>

<body id="app-layout" class="blank">

<div id="wrapper" class="toggled-2">
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="login-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="header-panel animated fadeIn">
                            <div class="hpanel hblue" style="margin-bottom: 20px;">
                                <div class="panel-heading hbuilt text-center">
                                    <h6>Жүйеге админ ретінде кіру</h6>
                                </div>
                                <div class="panel-body">
                                    @include('common.errors')
                                    <form role="form" method="POST" action="{{ url('/admin/login') }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label" for="username">Электронды жәшік</label>
                                            <input class="form-control" type="email" value="{{ old('email') }}" placeholder="example@mail.ru" name="email" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label" for="password">Құпия сөз</label>
                                            <input class="form-control" type="password" placeholder="******" required name="password">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="checkbox">
                                            <!-- Squared FOUR -->
                                            <div class="margin-left-20">
                                                <input type="checkbox" name="remember" />
                                                <label for="remember">Remember login</label>
                                            </div>
                                            <p class="help-block small">(if this is a private computer)</p>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block">Кіру</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        2015 Copyright Company Name
                    </div>
                </div>
            </div>
        </div>
        <!-- /#contentainer-fluid xyz -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- JavaScripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>