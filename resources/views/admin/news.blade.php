@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel ">
                <div class="panel-heading hbuilt">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Жаңалықтар тізімі</span>
                        </li>
                    </ol>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="searchFilterForm" action="" method="POST">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="checkbox" name="new_text_types" autocomplete="off" checked> Тақырыбы
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="checkbox" name="new_text_types" autocomplete="off"> Қысқа сипаттамасы
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="checkbox" name="new_text_types" autocomplete="off"> Кілт сөздер
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="checkbox" name="new_text_types" autocomplete="off"> Мәтіні
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Мәтін:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10">
                                    <input name="text" class="form-control" type="text" placeholder="Жаңалық мәтіні...">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-2 control-label text-left">Санаты:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="category">
                                        <option value="all" selected="selected">Барлығы</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-2 control-label text-left">Типі:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="category">
                                        <option value="all" selected="selected">Барлығы</option>
                                        <option>Аудармалар</option>
                                        <option>Таңдалғандар</option>
                                        <option>Жолданған ақпараттар</option>
                                        <option>Видео ақпараттар</option>
                                        <option>Слайд жаңалықтары</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-2 control-label text-left">Сұрыптау:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="category">
                                        <option value="all" selected="selected">Соңғы жаңалықтар</option>
                                        <option>Бастапқы жаңалықтар</option>
                                        <option>Көп оқылғандар</option>
                                        <option>Көп ұнатылғандар</option>
                                        <option>Көп пікір жазылғандар</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-2 control-label text-left">Уақыты:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <input name="datetime" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-2 control-label text-left">Авторы:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="category">
                                        <option value="all" selected="selected">Барлығы</option>
                                        @foreach($columnists as $columnist)
                                            <option value="{{ $columnist->id }}">
                                                {{ $columnist->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right">Қабылдау</button>
                    </form>
                </div>
            </div>
        </div>

        @foreach($news as $index => $new)
            <div id="{{$new->id}}" class="col-md-4 pull-left @if($index%3==0) clear-left @endif">
                <div class="hpanel blog-box">
                    @if(!is_null($new->avatar_picture))
                        <div class="panel-image">
                            <img class="img-responsive" src="{!! asset($new->avatar_picture) !!}">
                            <div class="title">
                                <a href="">
                                    <h4 style="color: inherit">{{ $new->title }}</h4>
                                </a>
                            </div>
                            @if(!is_null($new->video_url))
                                <span class="image-has-video">
                                    <i class="fa fa-video-camera"></i>
                                </span>
                            @endif
                            @if(!is_null($new->media_author))
                                <span class="image-author">{{$new->media_author}}</span>
                            @endif
                        </div>
                        <div class="panel-body">
                            <p>
                                {{$new->short_description}}
                            </p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="">Авторы:</div>
                                    <small>{{ \App\Admin::find($new->author_id)->name }}</small>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">Санаты:</div>
                                    <small>{{ \App\Category::find($new->category_id)->name }}</small>
                                </div>
                                <div class="col-sm-4">
                                    <div class="">Уақыты:</div>
                                    <small>{{ $new->created_at }}</small>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    <i class="fa fa-eye"></i>
                                    <small>{{ $new->views }}</small>
                                </div>
                                <div class="col-sm-3">
                                    <i class="fa fa-comment"></i>
                                    <small>{{ $new->comments_count() }}</small>
                                </div>
                                <div class="col-sm-3">
                                    <i class="fa fa-heart"></i>
                                    <small>{{ $new->likes }}</small>
                                </div>
                                <div class="col-sm-3">
                                    <i class="fa fa-share-alt"></i>
                                    <small>{{ $new->shares }}</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-t-md">
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-xs btn-default" onclick="set_as_sliderNew('{{$new->id}}')">Slider new</button>
                                        <button class="btn btn-xs btn-default" onclick="set_as_mainNew('{{$new->id}}')">Main new</button>
                                        <a href="{{ url('/admin/news/translate/'.$new->id) }}" class="btn btn-xs btn-default">Translate</a>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <a href="{{ url('/newsread/'.$new->id) }}" class="btn btn-xs btn-default">View</a>
                                        <a href="{{ url('/admin/new/edit/'.$new->id) }}" class="btn btn-xs btn-default">Edit</a>
                                        <button class="btn btn-xs btn-default" onclick="delete_new('{{$new->id}}')"> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="">
                                        <h4>{{ $new->title }}</h4>
                                    </a>
                                    <p>{!! str_limit($new->text, 200)!!}</p>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="">Авторы:</div>
                                            <small>{{ \App\Admin::find($new->author_id)->name }}</small>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="">Санаты:</div>
                                            <small>{{ \App\Category::find($new->category_id)->name }}</small>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="">Уақыты:</div>
                                            <small>{{ $new->created_at }}</small>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <i class="fa fa-eye"></i>
                                            <small>{{ $new->views }}</small>
                                        </div>
                                        <div class="col-sm-3">
                                            <i class="fa fa-comment"></i>
                                            <small>{{ $new->comments_count() }}</small>
                                        </div>
                                        <div class="col-sm-3">
                                            <i class="fa fa-heart"></i>
                                            <small>{{ $new->likes }}</small>
                                        </div>
                                        <div class="col-sm-3">
                                            <i class="fa fa-share-alt"></i>
                                            <small>{{ $new->shares }}</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 m-t-md">
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-xs btn-default" onclick="set_as_sliderNew('{{$new->id}}')">Slider new</button>
                                                <button class="btn btn-xs btn-default" onclick="set_as_mainNew('{{$new->id}}')">Main new</button>
                                                <a href="{{ url('/admin/news/translate/'.$new->id) }}" class="btn btn-xs btn-default">Translate</a>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <a href="{{ url('/newsread/'.$new->id) }}" class="btn btn-xs btn-default">View</a>
                                                <a href="{{ url('/admin/new/edit/'.$new->id) }}" class="btn btn-xs btn-default">Edit</a>
                                                <button class="btn btn-xs btn-default" onclick="delete_new('{{$new->id}}')"> Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="col-lg-12">
            <div class="pagination">
                {!! $news->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $( function () {
            $('#searchFilterForm').submit( function (event) {
                event.preventDefault();
                searchFilter();
            });
        });
        function searchFilter(){
            var types = $('input[name="new_text_types"]:checked').val();
            console.log(types);
        }

        function delete_new(id){
            $.get('{{ url('/admin/news/delete') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal("Өшірілді!", "Жаңалық сәтті өшірілді.", "success");
                    var target = $("#"+id);
                    target.hide('slow', function(){ target.remove(); });
                }
            });
        }

        function set_as_sliderNew(id){
            $.get('{{ url('/admin/news/slider') }}'+'/'+id, function(data) {
                if(data.message_type == 'success'){
                    swal("Қабылданды!", data.message, "success");
                }else{
                    swal("Woops...", data.message, "error");
                }
            });
        }

        function set_as_mainNew(id){
            $.get('{{ url('/admin/news/main') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal("Қабылданды!", "Жаңалық сәтті басты жаңалық ретінде таңдалды.", "success");
                }
            });
        }
    </script>
@endsection
