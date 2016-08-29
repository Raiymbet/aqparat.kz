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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/responsivestyle.css') }}">
</head>

<body id="print" class="fixed-navbar blank">
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
            <div id="text-content">
                {!! $new->text !!}
            </div>
            <p class="url">http://aqparat.kz/newsread/{{$new->id}}</p>
            <footer>
                <p>© 2016 Aqparat.kz</p>
            </footer>
        </header>
    </article>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.printme').click(function() {
            window.print();
        });
    });
</script>
</body>
</html>