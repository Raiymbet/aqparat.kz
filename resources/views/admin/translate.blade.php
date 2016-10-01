@extends('layouts.admin')

@section('head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-tagsinput.css') }}">
@endsection

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.7&appId=852011078263695";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Жаңалық аудару</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <span id="text_new" style="display: none">{{$new->text}}</span>
                    <form id="add_new"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input id="title" name="title" type="text" class="form-control" placeholder="Жаңалық тақырыбы">
                        </div>
                        <div class="form-group">
                            <select id="category" class="form-control" name="category">
                                <option selected value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="short_description" name="short_description" type="text" max="400" class="form-control" placeholder="Қысқаша сипаттамасы">
                        </div>
                        <div class="form-group">
                            <input id="keywords" data-role="tagsinput" class="form-control" type="text" name="keywords" placeholder="Жаңалыққа қатысты кілт сөздер">
                            <span class="help-block m-b-none text-info">Please, enter max keywords 20 and keywords must be simple words.</span>
                        </div>
                        <div class="form-group">
                            <select id="language" class="form-control" name="language">
                                <option value="kz" disabled>KZ</option>
                                <option selected value="ru">RU</option>
                                <option value="en">EN</option>
                            </select>
                        </div>
                        <div class="" id="news-content">
                            <div id="summernote" class="summernote"></div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right">Сақтау</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            // Initialize summernote plugin
            $('.summernote').summernote({
                maxHeight: 1700,
                minHeight: 400,
                toolbar: [
                    ['headline', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['alignment', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'help']]
                ]
            });
            var text = $('#text_new').text();
            $('#summernote').summernote('code', text);
        });

        $('#add_new').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var title = $('#title').val(),
                    category = $('#category').val(),
                    short_description = $('#short_description').val(),
                    keywords = $('#keywords').val(),
                    language = $('#language').val(),
                    text = $('#summernote').summernote('code');

            if(title && category && language && text && short_description && keywords){
                //ajax post the form
                var formData = new FormData($(this)[0]);
                formData.append('text', text);
                //console.log(formData);

                $.ajax({
                    url: '{{ url('/admin/news/translate/'.$new->id) }}',
                    type: 'post',
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (response) {
                        swal({
                            title: "Сәтті жұмыс!",
                            text: response,
                            type: "success"
                        });
                    }
                });
            }else{
                swal("Oops...", "Жаңалық мәліметтерін толықтырыңыз.", "error");
            }
        });
    </script>
@endsection