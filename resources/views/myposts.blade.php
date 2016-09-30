@extends('layouts.home')

@section('content')
    <?php $colors = array('text-green', 'text-red', 'text-blue', 'text-orange');?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">My Posts</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="hpanel forum-box">
                        <div class="panel-body">
                            <p>
                                <span>* <i class="fa fa-pencil-square-o fa-lg"></i></span> - Жолдама өңделу барысында. <br>
                                <span>* <i class="fa fa-square-o fa-lg"></i></span> - Жолдама өңделмеген. <br>
                                <span>* <i class="fa fa-check-square-o fa-lg"></i></span> - Жолдама өңделіп, расталған. <br>
                                <span>* <i class="fa fa-ban fa-lg"></i></span> - Жолдама өңделіп, расталмаған.
                            </p>
                        </div>

                        <!--
                        <div class="panel-body">
                            <form class="form-horizontal" action="{{url('/myposts/search')}}" method="POST">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="col-xs-3 col-sm-3 col-md-2 col-lg-2 control-label">Мәтіні:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
                                            <input name="post" class="form-control" type="text" placeholder="Жолдаманы іздеу...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Күйі:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
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
                                        <label class="col-xs-3 col-sm-3 col-md-4 col-lg-4 control-label">Уақыты:</label>
                                        <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8">
                                            <input name="datetime" type="datetime-local" class="form-control" placeholder="Уақытын көрсетіңіз">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <button class="btn btn-info pull-right" type="submit">Іздеу</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        -->
                    </div>

                    <div class="hpanel">
                        @if(!count($posts)>0)
                            <div class="panel-body" style="min-height: 300px;">
                                <p class="text-info">Сізде жолданған хабрламаларыңыз жоқ.</p>
                            </div>
                        @endif

                        @foreach($posts as $post)
                            <div class="panel-body">
                                <div class="">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="pull-left m-r-sm">
                                            @if($post->status == null)
                                                <i class="fa fa-square-o fa-lg"></i>
                                            @elseif($post->status == 'accepted')
                                                <i class="fa fa-check-square-o fa-lg"></i>
                                            @elseif($post->status == 'baned')
                                                <i class="fa fa-ban fa-lg"></i>
                                            @elseif($post->status == 'processing')
                                                <i class="fa fa-pencil-square-o fa-lg"></i>
                                            @endif
                                        </span>
                                        <p class="">
                                            <span class="text-muted">{{ $post->created_at->format('F j, Y, H:i') }}</span>
                                        </p>
                                        <h4 class="" id="post_text_{{$post->id}}">
                                               <strong>{{ $post->text }}</strong>
                                        </h4>

                                        <div>
                                            @if($post->news_id != null)
                                                <a href="{{ url('/newsread/'.$post->news_id) }}">Мақаланы оқу...</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <form id="post_form_{{$post->id}}">
                                            {{ csrf_field() }}
                                            <div class="form-group m-b-none">
                                                <textarea id="post_textarea_{{$post->id}}" class="form-control textarea-infocus" rows="1"
                                                          name="text" placeholder="Не хабар?"></textarea>
                                            </div>
                                            <div id="post-result-{{$post->id}}" class=""></div>
                                            <div class="form-group m-t">
                                                <button type="submit" class="btn btn-info pull-right" onclick="editSubmitForm('{{$post->id}}')">
                                                    Өзгерту
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="btn-group pull-right">
                                            <button type="submit" class="btn btn-sm btn-default" onclick="edit('{{$post->id}}', this)">Edit</button>
                                        </div>
                                    </div>
                                </div>
                                @if($post->status == 'baned')
                                    <div class="">
                                        <div class="col-sm-12 m-t-md">
                                            <div class="btn-group pull-right">
                                                <form action="{{url('/myposts/' . $post->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-sm btn-default"> Delete </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">

        function edit(id, btn) {
            $('#post_form_'+id).show();
            //console.log($('#post_text_'+id).hide().text());
            $('#post_textarea_'+id).val($('#post_text_'+id).hide().text().trim());
        }

        function editSubmitForm(id){
            $('#post_form_'+id).submit( function (e) {
                e.preventDefault();

                var post_text_area = $('#post_textarea_'+id),
                        post_text = post_text_area.val();
                console.log(post_text);
                if (post_text) {
                    $.post("{{ url('/post/edit') }}", {
                        post_id: id,
                        text: post_text
                    }).done(function (data) {
                        $('#post-result-'+id).removeClass().addClass('text-success').html(data.message);
                        setTimeout(function () {
                            $("#post-result-"+id).html('');
                            post_text_area.val('');
                            $('#post_form_'+id).hide();
                            $('#post_text_'+id).show().html('<strong>'+data.text+'</strong>');
                        }, 2000);
                    });
                } else {
                    $('#post-result-'+id).removeClass().addClass('text-danger').html("Хабарлама енгізіңіз!");
                    setTimeout(function () {
                        $("#post-result-"+id).html('');
                        $('#post_form_'+id).hide();
                        $('#post_text_'+id).show();
                    }, 2000);
                }
            });
        }

        $( function () {
            $('form').hide();
        });
    </script>
@endsection