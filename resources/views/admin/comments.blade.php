@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Пікірлер ({{ count($comments) }})</span>
                        </li>
                    </ol>
                </div>
                @if(count($comments) > 0)
                    <div id="comments" class="forum-box">
                        @foreach($comments as $comment)
                            <div class="panel-body" id="{{ $comment->id }}">
                                <div class="media">
                                    <div class="media-image pull-left">
                                        <img src="{{ isset($comment->user->avatar)?$comment->user->avatar:url('img/default_user.png')  }}" alt="Қолданушы суреті">
                                        <div class="author-info">
                                            <strong>{!! $comment->user->name !!}</strong>
                                            <br>
                                            {{ $comment->created_at }}
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $comment->text }}</p>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-default btn-sm" onclick="ban_comment('{{ $comment->id }}')">Ban</button>
                                        <button class="btn btn-default btn-sm" onclick="delete_comment('{{ $comment->id }}')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12">
                            <div class="pagination">
                                {!! $comments->render() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function delete_comment(id){
            $.get('{{url('/admin/comments/delete')}}'+'/'+id, function(data){
                swal({
                    title: "Сәтті жұмыс!",
                    text: data,
                    type: "success"
                },function(){
                    var target = $("#"+id);
                    target.hide('slow', function(){ target.remove(); });
                });
            });
        }

        function ban_comment(id){
            $.get('{{url('/admin/comments/ban')}}'+'/'+id, function(data){
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