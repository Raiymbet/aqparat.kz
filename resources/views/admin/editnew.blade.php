@extends('layouts.admin')

@section('head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
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
                        <div id="summernote" class="summernote"></div>
                        <button type="submit" class="btn btn-info pull-right">Сақтау</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#category').val({{$new->category_id}});
            $('#language').val('{{$new->language}}');
            // Initialize summernote plugin
            $('.summernote').summernote({
                height: 400,
                minHeight: 400,
                toolbar: [
                    ['headline', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['alignment', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'link', 'video', 'table']],
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
                    text = $('#summernote').summernote('code');
            if(title && category && language && text && short_description){
                //ajax post the form
                $.post("{{url('/admin/new/edit/'.$new->id)}}", {
                    title: title,
                    category: category,
                    language: language,
                    short_description: short_description,
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