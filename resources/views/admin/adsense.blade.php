@extends('layouts.admin')

@section('head')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Жарнама енгізу</span>
                        </li>
                    </ol>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="adSenseForm">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Title:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <input id="title" name="title" class="form-control" type="text" placeholder="Title...">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Location:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <select name="location" class="form-control">
                                        <option value="SliderBottom" selected>Slider bottom</option>
                                        <option value="SliderRight">Slider right</option>
                                        <option value="RightSide">Right Side</option>
                                        <option value="ColumnistRight">Columnist right side</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Code:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <textarea id="code" name="code" class="form-control" rows="8" placeholder="Code..."></textarea>
                                    <input type="checkbox" aria-label="Publish" onclick="checkPublish(this)">
                                    <label>Publish</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-12">
                                    <button type="submit" class="btn btn-info pull-right">Save</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-left">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Ads on bottom of slider</a></li>
                    </ol>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        @foreach(\App\AdSense::sliderBottom()->get() as $ads)
                            <tr id="{{$ads->id}}">
                                <td>
                                    <span>{{$ads->title}}</span>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        @if($ads->published)
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe liked"></i>
                                            </a>
                                        @else
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <a type="button" onclick="removeAds('{{$ads->id}}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-left">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Ads on right of slider</a></li>
                    </ol>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        @foreach(\App\AdSense::sliderRight()->get() as $ads)
                            <tr id="{{$ads->id}}">
                                <td>
                                    <span>{{$ads->title}}</span>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        @if($ads->published)
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe liked"></i>
                                            </a>
                                        @else
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <a type="button" onclick="removeAds('{{$ads->id}}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-left clear-left">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Ads on right side of body</a></li>
                    </ol>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        @foreach(\App\AdSense::rightSide()->get() as $ads)
                            <tr id="{{$ads->id}}">
                                <td>
                                    <span>{{$ads->title}}</span>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        @if($ads->published)
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe liked"></i>
                                            </a>
                                        @else
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <a type="button" onclick="removeAds('{{$ads->id}}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pull-left">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Ads on right of columnist</a></li>
                    </ol>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        @foreach(\App\AdSense::columnistRight()->get() as $ads)
                            <tr id="{{$ads->id}}">
                                <td>
                                    <span>{{$ads->title}}</span>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        @if($ads->published)
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe liked"></i>
                                            </a>
                                        @else
                                            <a type="button" onclick="publishOrUnPublish('{{$ads->id}}')">
                                                <i class="fa fa-globe"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <a type="button" onclick="removeAds('{{$ads->id}}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var publish = false;
        $( function () {
            $('#adSenseForm').submit( function (e) {
                e.preventDefault();
                var title = $('#title').val(),
                        location = $('select[name="location"]').val(),
                        code = $('#code').val();
                if(title && location && code){
                    $.ajax({
                        type: 'post',
                        data: {
                            title: title,
                            location: location,
                            code: code,
                            published: (publish)?1:0
                        },
                        success: function (response) {
                            $('.panel-body').append(response);
                        }
                    });
                }else{
                    swal({
                        title: "Oops...",
                        text: "Please, complete all data.",
                        type: "error"
                    });
                }
            });
        });

        function removeAds(id) {
            $.get('{{ url('/admin/adSense/delete') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal("Өшірілді!", "Қолданушы сәтті өшірілді.", "success");
                    var target = $("#"+id);
                    target.hide('slow', function(){ target.remove(); });
                }else{
                    $('.form-horizontal').append(data);
                }
            });
        }

        function publishOrUnPublish(id){
            var theme = "Published!",
                    message = "Ads is successfully published. Thank\'s!";
            if($('#'+id+' .fa-globe').hasClass('liked')) {
                $('#' + id + ' .fa-globe').removeClass('liked');
                theme = "Unpublished!";
                message = "Ads is successfully unpublished. Thank\'s!";
            }
            else {
                $('#' + id + ' .fa-globe').addClass('liked');
            }
            $.get('{{ url('/admin/adSense/publish') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal(theme, message, "success");
                }else{
                    $('.form-horizontal').append(data);
                }
            });
        }

        function checkPublish(checkbox){
            publish = !!checkbox.checked;
        }
    </script>
@endsection
