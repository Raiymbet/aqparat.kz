@extends('layouts.admin')

@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">

            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Профиль</span>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="hpanel hblue">
                        <div class="panel-body">
                            <img src="{{ URL::asset(Auth::guard('admin')->user()->avatar) }}" class="img-responsive">
                            <br>
                            <div class="stats-label text-color">
                                <p class="font-extra-bold">Username: {{ Auth::guard('admin')->user()->name }}</p>
                                <p class="font-extra-bold">Email: {{ Auth::guard('admin')->user()->email }}</p>
                                <p class="font-extra-bold">Occupation: {{ Auth::guard('admin')->user()->type }}</p>
                            </div>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="#" role="button" onclick="about()">
                                        <span class="fa-stack pull-left">
                                            <i class="fa fa-info fa-stack-1x "></i>
                                        </span>
                                        About
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" role="button" onclick="edit()">
                                        <span class="fa-stack pull-left">
                                            <i class="fa fa-edit fa-stack-1x "></i>
                                        </span>
                                        Edit
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" role="button">
                                        <span class="fa-stack pull-left">
                                            <i class="fa fa-unlock-alt fa-stack-1x "></i>
                                        </span>
                                        Reset Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="hpanel hgreen" id="about_panel">
                        <div class="panel-body">
                            <div class="col-lg-12" id="admin_info">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Username:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="">{{ Auth::guard('admin')->user()->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Email:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="">{{ Auth::guard('admin')->user()->email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Occupation:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="">{{ Auth::guard('admin')->user()->type }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>About:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p>
                                            @if(!is_null(Auth::guard('admin')->user()->adminDetails))
                                                {{ Auth::guard('admin')->user()->adminDetails->about }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Publications:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <h3 class="text-info">{{ Auth::guard('admin')->user()->newsCount() }}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Location:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <address>
                                            @if(!is_null(Auth::guard('admin')->user()->adminDetails))
                                                {{ Auth::guard('admin')->user()->adminDetails->location }}
                                            @endif
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <p><strong>Social links:</strong></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="btn-group">
                                            @if(!is_null(Auth::guard('admin')->user()->adminDetails))
                                                @if(!is_null( Auth::guard('admin')->user()->adminDetails->facebook ))
                                                    <a href="{{ Auth::guard('admin')->user()->adminDetails->facebook }}">
                                                        <i class="fa fa-facebook btn btn-default btn-xs"></i>
                                                    </a>
                                                @endif
                                                @if(!is_null( Auth::guard('admin')->user()->adminDetails->twitter ))
                                                    <a href="{{ Auth::guard('admin')->user()->adminDetails->twitter }}">
                                                        <i class="fa fa-twitter btn btn-default btn-xs"></i>
                                                    </a>
                                                @endif
                                                @if(!is_null( Auth::guard('admin')->user()->adminDetails->linkedIn ))
                                                    <a href="{{ Auth::guard('admin')->user()->adminDetails->linkedIn }}">
                                                        <i class="fa fa-linkedin btn btn-default btn-xs"></i>
                                                    </a>
                                                @endif
                                                @if(!is_null( Auth::guard('admin')->user()->adminDetails->googlePlus ))
                                                    <a href="{{ Auth::guard('admin')->user()->adminDetails->googlePlus }}">
                                                        <i class="fa fa-google-plus btn btn-default btn-xs"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="hpanel hgreen" id="edit_panel">
                        <div class="panel-body">
                            <div class="col-lg-12" id="admin_edit">
                                <form class="form-horizontal text-left" id="edit_form">
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Username:</p>
                                            <div class="col-lg-9">
                                                <input id="username" name="username" class="form-control" type="text" placeholder="Username..." >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Email:</p>
                                            <div class="col-lg-9">
                                                <input id="email" name="email" class="form-control" type="text" placeholder="Email..." >
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Password:</p>
                                            <div class="col-lg-9">
                                                <input id="password" name="password" class="form-control" type="password" placeholder="Password..." >
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Occupation:</p>
                                            <div class="col-lg-9">
                                                <select id="occupation" class="form-control" name="occupation">
                                                    @if(Auth::guard('admin')->user()->type =='admin')
                                                        <option selected value="admin">Admin</option>
                                                    @elseif(Auth::guard('admin')->user()->type =='moderator')
                                                        <option value="moderator">Moderator</option>
                                                    @elseif(Auth::guard('admin')->user()->type =='columnist')
                                                        <option value="columnist">Columnist</option>
                                                    @elseif(Auth::guard('admin')->user()->type =='journalist')
                                                        <option value="journalist">Journalist</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Image:</p>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="file" name="avatar" id="avatar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">About:</p>
                                            <div class="col-lg-9">
                                                <textarea id="about" name="about" rows="6" class="form-control" placeholder="Small information..." ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Location:</p>
                                            <div class="col-lg-9">
                                                <input id="location" name="location" class="form-control" type="text" placeholder="City, Country" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <p class="col-lg-3 control-label font-extra-bold">Social links:</p>
                                            <div class="col-lg-9">
                                                <input id="facebook" name="facebook" class="form-control" type="text" placeholder="Facebook" >
                                                <input id="twitter" name="twitter" class="form-control" type="text" placeholder="Twitter" >
                                                <input id="linkedIn" name="linkedIn" class="form-control" type="text" placeholder="LinkedIn" >
                                                <input id="googlePlus" name="googlePlus" class="form-control" type="text" placeholder="Google Plus" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <button class="btn btn-info pull-right" type="submit">Сақтау</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#edit_panel').hide();

        $('.nav.nav-pills.nav-stacked > li > a').click(function() {
            $('.nav.nav-pills.nav-stacked > li').removeClass();
            $(this).parent().addClass('active');
        });

        function about() {
            $('#edit_panel').hide();
            $('#about_panel').show();
        }

        function edit() {
            $('#about_panel').hide();
            $('#edit_panel').show();

            $('#username').val('{{ Auth::guard('admin')->user()->name }}');
            $('#email').val('{{ Auth::guard('admin')->user()->email }}');
            $('#occupation').val('{{ Auth::guard('admin')->user()->type }}');
            @if(!is_null(Auth::guard('admin')->user()->adminDetails))
                $('#about').val('{{Auth::guard('admin')->user()->adminDetails->about}}');
                $('#location').val('{{Auth::guard('admin')->user()->adminDetails->location}}');
                $('#facebook').val('{{Auth::guard('admin')->user()->adminDetails->facebook}}');
                $('#twitter').val('{{Auth::guard('admin')->user()->adminDetails->twitter}}');
                $('#linkedIn').val('{{Auth::guard('admin')->user()->adminDetails->linkedIn}}');
                $('#googlePlus').val('{{Auth::guard('admin')->user()->adminDetails->googlePlus}}');
            @endif
        }

        function reset_password(){

        }

        $('#edit_form').submit( function (event) {
            event.preventDefault();

            var username = $('#username').val(),
                    email = $('#email').val(),
                    occupation = $('#occupation').val(),
                    about = $('#about').val(),
                    location = $('#location').val();
                    /*socials = [
                        $('#facebook').val(),
                        $('#twitter').val(),
                        $('#linkedIn').val(),
                        $('#googlePlus').val()
                    ];*/
            if(username && email && about && location){
                //ajax post the form
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '{{ url('/admin/profile') }}',
                    type: 'post',
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (response) {
                        if(response.message_type == 'success'){
                            swal({
                                title: "Сәтті жұмыс!",
                                text: response.message,
                                type: "success"
                            },function(){
                                location.reload();
                            });
                        }else{
                            swal({
                                title: "Oops...",
                                text: response.message,
                                type: "error"
                            });
                        }
                    }
                });
            }else{
                swal("Oops...", "Қолданушы мәліметтерін енгізіңіз.", "error");
            }

        });
    </script>
@endsection