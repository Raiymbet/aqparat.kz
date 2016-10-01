<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsivestyle.css') }}">
</head>

<body id="app-layout" class="blank">
<!-- Including GOOGLE UNIVERSAL ANALYTICS -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-82670042-1', 'auto');
    ga('send', 'pageview');
</script>
<div id="" class="">
    <!-- Page Content -->
    <div id="">
        <div class="container-fluid xyz">
            <div class="login-container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="header-panel animated fadeIn">
                            <div class="hpanel hblue m-b-md">
                                <div class="panel-heading hbuilt text-center">
                                    <h6>Әлеуметтік желі арқылы кіру</h6>
                                </div>
                                <div class="panel-body">
                                    <a class="btn btn-info btn-block margin-bottom-10" href="{{ url('socialite/facebook') }}" style="background-color: #3a579a">
                                        <i class="fa fa-facebook fa-lg pull-left"></i> Login with Facebook
                                    </a>
                                    <a class="btn btn-info btn-block margin-bottom-10" href="{{ url('socialite/twitter') }}" style="background-color: #00abf0">
                                        <i class="fa fa-twitter fa-lg pull-left"></i> Login with Twitter
                                    </a>
                                    <a class="btn btn-info btn-block margin-bottom-10" href="{{ url('socialite/google') }}" style="background-color: #df4a32">
                                        <i class="fa fa-google-plus fa-lg pull-left"></i> Login with Google
                                    </a>
                                    <!--<a class="btn btn-info btn-block margin-bottom-10" href="{{ url('socialite/vk') }}" style="background-color: #54769a">
                                        <i class="fa fa-vk fa-lg pull-left"></i> Login with Vk
                                    </a>-->
                                    <div class="checkbox">
                                        <!-- Squared FOUR -->
                                        <div class="m-l-md">
                                            <input type="checkbox" value="None" id="remember" name="check" />
                                            <label for="remember">Remember login</label>
                                        </div>
                                        <p class="help-block small">(if this is a private computer)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <i class="fa fa-copyright"></i> 2016 Aqparat.kz
                    </div>
                </div>
            </div>
        </div>
        <!-- /#contentainer-fluid xyz -->
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>