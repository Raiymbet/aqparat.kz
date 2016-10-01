@extends('layouts.admin')

@section('head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-tagsinput.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Жаңалық қосу</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <span id="text_new" style="display: none">{{$new->text}}</span>
                    <form id="edit_new">
                        <div class="form-group">
                            <input id="title" value="{{$new->title}}" name="title" type="text" class="form-control" placeholder="Жаңалық тақырыбы">
                        </div>
                        <div class="form-group">
                            <select id="category" class="form-control" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="short_description" value="{{$new->short_description}}" name="short_description" type="text" max="400" class="form-control" placeholder="Қысқаша сипаттама">
                        </div>
                        <div class="form-group">
                            <select id="language" class="form-control" name="language">
                                <option selected value="kz">KZ</option>
                                <option value="ru">RU</option>
                                <option value="en">EN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="media_author" value="{{$new->media_author}}" type="text" class="form-control" name="media_author" placeholder="Сурет немесе видео авторы">
                        </div>
                        <div class="form-group">
                            <input id="keywords" value="{{$new->tags}}" data-role="tagsinput" class="form-control" type="text" name="keywords" placeholder="Жаңалыққа қатысты кілт сөздер">
                            <span class="help-block m-b-none text-info">Please enter keywords through commas, for example: Kazakhstan, Boxing, GGG, Golovkyn</span>
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
            $('#category').val({{$new->category_id}});
            $('#language').val('{{$new->language}}');
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

        $('#edit_new').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var title = $('#title').val(),
                    short_description = $('#short_description').val(),
                    category = $('#category').val(),
                    language = $('#language').val(),
                    media_author = $('#media_author').val(),
                    tags = $('#keywords').val(),
                    text = $('#summernote').summernote('code');
            if(title && category && language && text && short_description){
                //ajax post the form
                $.post("{{url('/admin/new/edit/'.$new->id)}}", {
                    title: title,
                    category: category,
                    short_description: short_description,
                    language: language,
                    media_author: media_author,
                    tags: tags,
                    text: text
                }).done(function(data) {
                    swal({
                        title: "Сәтті жұмыс!",
                        text: data,
                        type: "success"
                    },function(){
                        window.location.replace('{{url('/admin/news')}}');
                    });
                });

            }else{
                swal("Oops...", "Жаңалық мәліметтерін толықтырыңыз.", "error");
            }
        });
    </script>
@endsection