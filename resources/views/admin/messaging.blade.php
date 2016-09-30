@extends('layouts.admin')

@section('head')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Хат жолдау</span>
                        </li>
                    </ol>
                </div>
                <div id="panel-content-body" class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a target="_blank" class="btn btn-default pull-right" href="https://emailmg.ipage.com/roundcube/?_task=mail&_mbox=INBOX">
                            Go to info@aqparat.kz
                        </a>
                    </div>
                    <form id="sendEmailForm" class="form-horizontal">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Кімге:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" onclick="checkAll(this)" aria-label="All">All
                                        </span>
                                        <select class="form-control no-padding no-borders" id="tagPicker" multiple="multiple">
                                            @foreach($users as $user)
                                                <option value="{{$user->email}}">{{$user->name}} < {{$user->email}} ></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Шаблон:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <select id="emailTemplate" class="form-control" onchange="">
                                        <option value="custom">Custom</option>
                                        <option value="verify">User verification</option>
                                        <option value="reminder">Reminder</option>
                                        <option value="password">Password Update</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-4 col-md-2 col-lg-1 control-label text-left">Subject:</label>
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-11">
                                    <input id="subject" name="text" class="form-control" type="text" placeholder="Subject...">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="summernote"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-12">
                                    <button type="submit" class="btn btn-info pull-right">Send email</button>
                                    <button type="submit" class="btn btn-info pull-right m-r-xs">Discard</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js"></script>
    <script type="text/javascript">
        var toUsersAll = false;
        $(function () {
            /* Select2 plugin as tagpicker */
            $("#tagPicker").select2({
                closeOnSelect:false
            });

            $('#emailTemplate').on('change', function() {
                if($(this).val() != 'custom'){
                    $('.summernote').summernote('disable');
                    $('#subject').val($('#emailTemplate option:selected').text());
                }else{
                    $('.summernote').summernote('enable');
                }
            });
            // Initialize summernote plugin
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['headline', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['textsize', ['fontsize']],
                    ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
                ]
            });

            $('#sendEmailForm').submit( function (e) {
                e.preventDefault();
                var users,
                        template = $('#emailTemplate').val(),
                        subject = $('#subject').val(),
                        content = $('.summernote').summernote('code');

                if(!toUsersAll)
                        users = $('#tagPicker').val();

                $.ajax({
                    type: 'post',
                    data: {
                        users: users,
                        toUsersAll: toUsersAll,
                        template: template,
                        subject: subject,
                        content: content
                    },
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
                            //$('#panel-content-body').append(response);
                        }
                    }
                });
            });
        });

        function checkAll(checkbox){
            console.log(checkbox.checked);
            if(checkbox.checked){
                $('#tagPicker').attr({
                    'disabled': 'disabled'
                });
                toUsersAll = true;
            }else{
                $('#tagPicker').removeAttr('disabled');
                toUsersAll = false;
            }
        }
    </script>
@endsection
