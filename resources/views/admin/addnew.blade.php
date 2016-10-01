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
                            <input id="short_description" name="short_description" type="text" max="400" class="form-control" placeholder="Қысқаша сипаттамасы">
                        </div>
                        <div class="form-group">
                            <select id="language" class="form-control" name="language">
                                <option selected value="kz">KZ</option>
                                <option disabled value="ru">RU</option>
                                <option disabled value="en">EN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="video" type="file" class="form-control" name="video" placeholder="">
                            <span class="help-block m-b-none text-info">Choose video file if you have...</span>
                        </div>
                        <div class="form-group">
                            <input id="image" type="file" class="form-control" name="image" placeholder="Жаңалық суреті">
                            <span class="help-block m-b-none text-info">Choose image file for new avatar. Please, don't leave empty!</span>
                        </div>
                        <div class="form-group">
                            <input id="media_author" type="text" class="form-control" name="media_author" placeholder="Сурет немесе видео авторы">
                        </div>
                        <div class="form-group">
                            <input id="keywords" data-role="tagsinput" class="form-control" type="text" name="keywords" placeholder="Жаңалыққа қатысты кілт сөздер">
                            <span class="help-block m-b-none text-info">Please, enter max keywords 20 and keywords must be simple words.</span>
                        </div>

                        <div class="m-b-sm" style="border-bottom: 2px solid #cccccc;"></div>

                        <div class="m-b-sm">
                            <button onclick="addParagraph()" type="button" class="btn btn-default">
                                Add Paragraph
                            </button>
                            <button class="btn btn-default" type="button" onclick="showAddBloquote()">
                                Add Bloquote
                            </button>
                            <button onclick="showInsertImage()" type="button" class="btn btn-default">
                                <i class="fa fa-picture-o"></i>
                            </button>
                            <button onclick="showInsertVideo()" type="button" class="btn btn-default">
                                <i class="fa fa-video-camera"></i>
                            </button>
                            <button onclick="eraseContent()" type="button" class="btn btn-default">
                                <i class="fa fa-eraser"></i>
                            </button>
                            <button onclick="" type="button" class="btn btn-default">Remove Last Element(not worked)</button>
                            <button onclick="preview()" type="button" class="btn btn-default">
                                Preview(not worked)
                            </button>
                        </div>

                        <div class="m-b-sm" style="border-bottom: 2px solid #cccccc;"></div>

                        <div id="add-bloquote-content" class="form-group m-t add-media-content">
                            <input type="text" id="bloquote-text" class="form-control" placeholder="Bloquote text">
                            <div class="input-group">
                                <input type="text" id="bloquote-author" class="form-control" placeholder="Author">
                                <a class="input-group-addon btn btn-default" role="button"
                                   id="btn-addon" onclick="addBloquote()">Ok</a>
                                <a class="input-group-addon btn btn-default" role="button"
                                   onclick="hideAddBloquote()">Cancel</a>
                            </div>
                        </div>

                        <div id="post-video-content" class="form-group m-t add-media-content">
                            <label class="control-label">
                                Видео жазба сілтемесі
                            </label>
                            <input type="text" id="video-description" class="form-control" placeholder="Video description">
                            <input type="text" id="add-video-auhtor" class="form-control" placeholder="Video author">
                            <div class="input-group">
                                <input type="url" id="post-video-url" class="form-control"
                                       placeholder="Video url" aria-describedby="btn-addon">
                                <a class="input-group-addon btn btn-default" role="button"
                                   id="btn-addon" onclick="setVideoUrl()">Ok</a>
                                <a class="input-group-addon btn btn-default" role="button"
                                    onclick="hideInsertVideo()">Cancel</a>
                            </div>
                        </div>

                        <div id="add-image-content" class="form-group m-t add-media-content">
                            <label class="control-label">
                                Суретті таңдаңыз немесе сілтемесін енгізіңіз:
                            </label>
                            <input type="text" id="image-description" class="form-control" placeholder="Image description">
                            <input type="text" id="add-image-author" class="form-control" placeholder="Image author">
                            <input type="file" id="upload-image" name="upload-image" class="form-control"
                                   accept="image/gif, image/jpeg, image/png"
                                   onchange="readURL(this)">
                            <div class="input-group">
                                <input type="url" id="add-image-url" class="form-control"
                                       placeholder="Image URL" aria-describedby="btn-addon">
                                <a class="input-group-addon btn btn-default" role="button"
                                   id="btn-addon" onclick="setImageUrl()">Ok</a>
                                <a class="input-group-addon btn btn-default" role="button"
                                   onclick="hideInsertImage()">Cancel</a>
                            </div>
                        </div>

                        <div class="" id="news-content"></div>

                        <button type="submit" class="btn btn-info pull-right">Сақтау</button>
                        <button type="button" onclick="discard()" class="btn btn-info pull-right">Discard</button>
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
            hideAddBloquote();
            hideInsertVideo();
            hideInsertImage();
        });

        window.onbeforeunload = function() {
            console.log('You have unsaved data!');
            discard();
            console.log('You unsaved data removed!');
        };

        var paragraph_count = 0, trashHasDocs = false, trashFiles = [];
        function addParagraph(){
            paragraph_count+=1;
            $('#news-content').append('<div class="content-summernote" id="content-summernote-'+paragraph_count+'">' +
                    '<button type="button" onclick="addParagraphAccept('+paragraph_count+')" class="btn btn-default">Save</button>' +
                    '<button type="button" onclick="addParagraphEdit('+paragraph_count+')" class="btn btn-default">Edit</button>' +
                    '<button type="button" onclick="addParagraphRemove('+paragraph_count+')" class="btn btn-default">Remove</button>' +
                    '<div id="summernote-'+paragraph_count+'" class="summernote"></div></div>');
            $('#summernote-'+paragraph_count).summernote({
                height: 150,
                minHeight: 150,
                toolbar: [
                    ['headline', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['alignment', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table']],
                    ['misc', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }
        function addParagraphAccept(id){
            var code = $('#summernote-'+id).summernote('code');
            //$('#news-content').append(code);
            $('#summernote-'+id).summernote('destroy');
        }
        function addParagraphEdit(id){
            $('#summernote-'+id).summernote({
                height: 150,
                minHeight: 150,
                toolbar: [
                    ['headline', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['alignment', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table']],
                    ['misc', ['fullscreen', 'codeview', 'help']]
                ],
                focus: true});
        }
        function addParagraphRemove(id) {
            $('#content-summernote-'+id).remove();
        }

        function showInsertImage() {
            $('#add-image-content').show();
        }
        function hideInsertImage() {
            $('#add-image-content').hide();
        }
        function setImageUrl(){
            var image_url = $('#add-image-url').val(),
                    image_description = $('#image-description').val(),
                    image_author = $('#add-image-author').val(),
                    container = $('<div></div>').attr('class', 'main-news-image-content'),
                    description = $('<p></p>').attr('class', 'image-description'),
                    author = $('<span></span>').attr('class', 'image-author'),
                    image = $('<img>')
                            .attr('src', image_url)
                            .attr('class', 'img-responsive');
            container.append(image);
            if(image_author){
                author.text(image_author);
                container.append(author);
            }
            $('#news-content').append(container);
            if(image_description){
                description.text(image_description);
                $('#news-content').append(description);
            }
            hideInsertImage();
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var formData = new FormData();
                formData.append('file', $('#upload-image')[0].files[0]);
                var image_description = $('#image-description').val(),
                        image_author = $('#add-image-author').val(),
                        container = $('<div></div>').attr('class', 'main-news-image-content'),
                        description = $('<p></p>').attr('class', 'image-description'),
                        author = $('<span></span>').attr('class', 'image-author');
                $.ajax({
                    url: '{{ url('/admin/image/upload') }}',
                    type: 'post',
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (response) {
                        console.log(response);
                        container.append($('<img>').attr('class', 'news-content-image').attr('src', response));
                        if(image_author){
                            author.text(image_author);
                            container.append(author);
                        }
                        $('#news-content').append(container);
                        if(image_description){
                            description.text(image_description);
                            $('#news-content').append(description);
                        }
                        if(!trashHasDocs){
                            trashHasDocs = true;
                        }
                        trashFiles.push(response);
                    }
                });
                hideInsertImage();
            }
        }

        var videoEmbed = {
            invoke: function (url) {
                var video_description = $('#video-description').val(),
                        video_author = $('#add-video-auhtor').val(),
                        container = $('<div></div>').attr('class', 'main-news-image-content'),
                        description = $('<p></p>').attr('class', 'image-description'),
                        author = $('<span></span>').attr('class', 'image-author');
                container.append(videoEmbed.convertMedia(url));
                if(video_author){
                    author.text(video_author);
                    container.append(author);
                }
                $('#news-content').append(container);
                if(video_description){
                    description.text(video_description);
                    $('#news-content').append(description);
                }
            },
            convertMedia: function (url) {

                var ytRegExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var ytMatch = url.match(ytRegExp);
                //console.log(ytMatch);

                var igRegExp = /(?:www\.|\/\/)instagram\.com\/p\/(.[a-zA-Z0-9_-]*)/;
                var igMatch = url.match(igRegExp);

                var vRegExp = /\/\/vine\.co\/v\/([a-zA-Z0-9]+)/;
                var vMatch = url.match(vRegExp);

                var vimRegExp = /\/\/(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/;
                var vimMatch = url.match(vimRegExp);

                var dmRegExp = /.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/;
                var dmMatch = url.match(dmRegExp);

                var youkuRegExp = /\/\/v\.youku\.com\/v_show\/id_(\w+)=*\.html/;
                var youkuMatch = url.match(youkuRegExp);

                var mp4RegExp = /^.+.(mp4|m4v)$/;
                var mp4Match = url.match(mp4RegExp);

                var oggRegExp = /^.+.(ogg|ogv)$/;
                var oggMatch = url.match(oggRegExp);

                var webmRegExp = /^.+.(webm)$/;
                var webmMatch = url.match(webmRegExp);

                var fbRegExp = /^http(?:s?):\/\/(?:www\.|web\.|m\.)?facebook\.com\/([A-z0-9\.]+)\/videos(?:\/[0-9A-z].+)?\/(\d+)(?:.+)?$/;
                var fbMatch = url.match(fbRegExp);
                console.log(fbMatch);

                var $video;
                if (ytMatch && ytMatch[1].length === 11) {
                    var youtubeId = ytMatch[1];
                    $video = $('<iframe>')
                            .attr('frameborder', 0)
                            .attr('src', '//www.youtube.com/embed/' + youtubeId)
                            .attr('width', '100%').attr('height', '460');
                }else if(fbMatch && fbMatch[2].length){
                    $video = $('<div>')
                            .attr('data-href', url)
                            .attr('data-allowfullscreen', 'true')
                            .attr('data-width', '740')
                            .attr('class', 'fb-video');
                    //console.log($video);
                } else if (igMatch && igMatch[0].length) {
                    $video = $('<iframe>')
                            .attr('frameborder', 0)
                            .attr('src', 'https://instagram.com/p/' + igMatch[1] + '/embed/')
                            .attr('width', '612').attr('height', '710')
                            .attr('scrolling', 'no')
                            .attr('allowtransparency', 'true');
                } else if (vMatch && vMatch[0].length) {
                    $video = $('<iframe>')
                            .attr('frameborder', 0)
                            .attr('src', vMatch[0] + '/embed/simple')
                            .attr('width', '600').attr('height', '600')
                            .attr('class', 'vine-embed');
                } else if (vimMatch && vimMatch[3].length) {
                    $video = $('<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>')
                            .attr('frameborder', 0)
                            .attr('src', '//player.vimeo.com/video/' + vimMatch[3])
                            .attr('width', '640').attr('height', '360');
                } else if (dmMatch && dmMatch[2].length) {
                    $video = $('<iframe>')
                            .attr('frameborder', 0)
                            .attr('src', '//www.dailymotion.com/embed/video/' + dmMatch[2])
                            .attr('width', '640').attr('height', '360');
                } else if (youkuMatch && youkuMatch[1].length) {
                    $video = $('<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>')
                            .attr('frameborder', 0)
                            .attr('height', '498')
                            .attr('width', '510')
                            .attr('src', '//player.youku.com/embed/' + youkuMatch[1]);
                } else if (mp4Match || oggMatch || webmMatch) {
                    $video = $('<video controls>')
                            .attr('src', url)
                            .attr('width', '640').attr('height', '360');
                } else {
                    // this is not a known video link. Now what, Cat? Now what?
                    return false;
                }

                return $video;
            }
        };
        function showInsertVideo(){
            $('#post-video-content').show();
        }
        function hideInsertVideo(){
            $('#post-video-content').hide();
        }
        function setVideoUrl(){
            var video_url = $('#post-video-url').val();
            //$('#post-video-content').hide();
            //console.log(video_url);
            videoEmbed.invoke(video_url);
            FB.XFBML.parse();
            hideInsertVideo();
        }

        function eraseContent(){
            $('#news-content').html('');
            paragraph_count = 0;
        }

        function preview(){

        }
        function discard(){
            $('#add_new')[0].reset();
            $('#keywords').tagsinput('removeAll');
            eraseContent();
            if(trashHasDocs){
                console.log(trashFiles);
                $.post('{{url('/admin/new/trash/clean')}}', {'files': trashFiles}, function (data) {
                    console.log(data);
                });
            }
        }

        function showAddBloquote(){
            $('#add-bloquote-content').show();
        }
        function hideAddBloquote(){
            $('#bloquote-text').val('');
            $('#bloquote-author').val('');
            $('#add-bloquote-content').hide();
        }
        function addBloquote() {
            var bloquote_text = $('#bloquote-text').val(),
                    bloquote_author = $('#bloquote-author').val(),
                    bloquote = $('<p></p>').attr('class', 'quote'),
                    author = $('<p></p>').attr('class', 'bloquote-author');
            if(bloquote_text && bloquote_author){
                author.text(bloquote_author);
                bloquote.text(bloquote_text);
                $('#news-content').append(bloquote, author);
            }
            hideAddBloquote();
        }

        $('#add_new').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();
            $( "#news-content button" ).remove();
            var title = $('#title').val(),
                    category = $('#category').val(),
                    short_description = $('#short_description').val(),
                    language = $('#language').val(),
                    media_author = $('#media_author').val(),
                    tags = $('#keywords').val(),
                    text = $('#news-content').html();
            //console.log(text);

            if(title && category && short_description && language && media_author && tags && text){
                //ajax post the form
                var formData = new FormData($(this)[0]);
                formData.append('text', text);
                if(trashHasDocs){
                    formData.append('trashFiles', trashFiles);
                }
                @if(!empty($postId))
                    formData.append('postId', '{{$postId}}');
                @endif
                //console.log(formData);
                $.ajax({
                    url: '{{ url('/admin/new/add') }}',
                    type: 'post',
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (response) {
                        if(response.messageType == 'success'){
                            swal({
                                title: "Сәтті жұмыс!",
                                text: response.message,
                                type: "success"
                            });
                        }else if(response.messageType == 'error'){
                            console.log(response.message);
                            swal({
                                title: "Oops...",
                                text: response.message,
                                type: "error"
                            });
                        }else{
                            console.log(response);
                        }
                    }
                });

            }else{
                swal("Oops...", "Жаңалық мәліметтерін толықтырыңыз.", "error");
            }
        });
    </script>
@endsection