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
                    <form id="add_new"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input id="title" name="title" type="text" class="form-control" placeholder="Жаңалық тақырыбы">
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
                            <select id="language" class="form-control" name="language">
                                <option selected value="kz">KZ</option>
                                <option value="ru">RU</option>
                                <option value="en">EN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="image" type="file" class="form-control" name="image">
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
        });

        $('#add_new').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var title = $('#title').val(),
                    category = $('#category').val(),
                    language = $('#language').val(),
                    text = $('#summernote').summernote('code');

            if(title && category && language && text){
                //ajax post the form
                var formData = new FormData($(this)[0]);
                formData.append('text', text);
                @if(!empty($postId))
                    formData.append('postId', '{{$postId}}');
                @endif
                console.log(formData);

                $.ajax({
                    url: '{{ url('/admin/new/add') }}',
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
                /*$.post("{{url('/admin/new/add')}}", {
                    title: title,
                    category: category,
                    language: language,
                    text: text
                }).done(function(data) {
                    swal({
                        title: "Сәтті жұмыс!",
                        text: data,
                        type: "success"
                    },function(){
                        location.reload();
                    });
                });*/

            }else{
                swal("Oops...", "Жаңалық мәліметтерін толықтырыңыз.", "error");
            }
        });
    </script>
@endsection