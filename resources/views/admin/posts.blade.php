@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Жолдамалар</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <p>
                        <span>* <i class="fa fa-pencil-square-o fa-lg"></i></span> - Жолдама өңделу барысында. <br>
                        <span>* <i class="fa fa-square-o fa-lg"></i></span> - Жолдама өңделмеген. <br>
                        <span>* <i class="fa fa-check-square-o fa-lg"></i></span> - Жолдама өңделіп, расталған. <br>
                        <span>* <i class="fa fa-ban fa-lg"></i></span> - Жолдама өңделіп, расталмаған.
                    </p>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" action="" method="POST">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-2 control-label text-left">Мәтін:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10">
                                    <input name="post" class="form-control" type="text" placeholder="Жолдама мәтіні...">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label text-left">Күйі:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="status">
                                        <option value="all" selected="selected">Барлығы</option>
                                        <option value="">Өңделмеген</option>
                                        <option value="accepted">Расталған</option>
                                        <option value="baned">Расталмаған</option>
                                        <option value="processing">Өңделуде</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label text-left">Уақыты:</label>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <input name="datetime" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="hpanel">
                @foreach($posts as $post)
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                <span>
                                    @if($post->status == null)
                                        <i class="fa fa-square-o fa-lg m-r"></i>
                                    @elseif($post->status == 'accepted')
                                        <i class="fa fa-check-square-o fa-lg m-r"></i>
                                    @elseif($post->status == 'baned')
                                        <i class="fa fa-ban fa-lg m-r"></i>
                                    @elseif($post->status == 'processing')
                                        <i class="fa fa-pencil-square-o fa-lg m-r"></i>
                                    @endif
                                </span>
                                    {{ $post->created_at }}
                                </h5>
                                <div>
                                    <p>{{ $post->text }}</p>
                                    @if($post->news_id != null)
                                        <a href="{{ url('/newsread/'.$post->news_id) }}">Мақаланы оқу...</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 m-t-md">
                                <div class="btn-group pull-right">

                                    @if(Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'moderator')
                                        <button class="btn btn-sm btn-default" onclick="accept_post('{{$post->id}}')"> Accept</button>
                                        <button class="btn btn-sm btn-default" onclick="ban_post('{{$post->id}}')"> Ban</button>
                                        @if($post->status != 'processing')
                                            <button class="btn btn-sm btn-default" onclick="processing_post('{{$post->id}}')"> Processing</button>
                                        @elseif($post->status == 'processing')
                                            <a class="btn btn-sm btn-default" href="{{url('/admin/posts/writenew/'.$post->id)}}" >Write New</a>
                                        @endif
                                        <button class="btn btn-sm btn-default" onclick="delete_post('{{$post->id}}')"> Delete</button>
                                    @else
                                        @if($post->status != 'processing')
                                            <button class="btn btn-sm btn-default" onclick="processing_post('{{$post->id}}')"> Processing</button>
                                        @elseif($post->status == 'processing')
                                            <a class="btn btn-sm btn-default" href="{{url('/admin/posts/writenew/'.$post->id)}}" >Write New</a>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination">
                            {!! $posts->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function accept_post(id){
            $.get('{{url('/admin/posts/accept')}}'+'/'+id, function(data){
                swal({
                    title: "Сәтті жұмыс!",
                    text: data,
                    type: "success"
                },function(){
                    location.reload();
                });
            });
        }

        function ban_post(id){
            $.get('{{url('/admin/posts/ban')}}'+'/'+id, function(data){
                swal({
                    title: "Сәтті жұмыс!",
                    text: data,
                    type: "success"
                },function(){
                    location.reload();
                });
            });
        }

        function processing_post(id){
            $.get('{{url('/admin/posts/processing')}}'+'/'+id, function(data){
                swal({
                    title: "Сәтті жұмыс!",
                    text: data,
                    type: "success"
                },function(){
                    location.reload();
                });
            });
        }

        function delete_post(id){
            $.get('{{url('/admin/posts/delete')}}'+'/'+id, function(data){
                swal({
                    title: "Сәтті жұмыс!",
                    text: data,
                    type: "success"
                },function(){
                    location.reload();
                });
            });
        }

    </script>
@endsection