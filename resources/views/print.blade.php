<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $new->title }}</title>
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsivestyle.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/print.css') }}">
</head>

<body id="print">
<!-- Including GOOGLE UNIVERSAL ANALYTICS -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-82670042-1', 'auto');
    ga('send', 'pageview');
</script>
    <article>
        <header>
            <a href="#" class="btn btn-info pull-right printme">Print</a>
            <a href="#">
                <img src="{{ asset('img/logo_for_print.png') }}" style="">
            </a>
            <h4>{{ $new->category->name }}</h4>
            <div>
                <img src="{{ asset($new->author->avatar) }}" height="100" width="100" alt="" class="avatar hide-small" itemprop="image">
                <h5>{{ $new->author->name }}</h5>
                <p>
                    {{ $new->author->adminDetails->about }}
                    <br>
                </p>
            </div>
            <span class="pull-left">
                {{ $new->created_at->format('F d, H:i') }}
            </span>
            <br>
            <h2>
                <a href="#">
                    <strong>{{ $new->title }}</strong>
                </a>
            </h2>
            <br>
        </header>
        <div id="text-content">
            {!! $new->text !!}
        </div>
        <p class="url">http://aqparat.kz/newsread/{{$new->id}}</p>
        <footer>
            <p>© 2016 Aqparat.kz</p>
        </footer>
    </article>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $('.printme').click(function() {
        window.print();
    });
</script>
</body>
</html>