@extends('layouts.home')


@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-two text-uppercase" style="background: #3a97bf; color: #FFFFFF; margin-top: 1px;">
        <div class="header-row">
            <span class="m-l-xs">Profile</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 header-three">
        <div class="row header-row">
            <div class="row-content">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">
                            <div id="profile-info" class="media">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-2 pull-left p-r-xs m-b-md">
                                        <img class="" height="100" width="100" src="{{ URL::asset($user->avatar) }}" alt="Қолданушы суреті">
                                        <br>
                                        @if($user->id==Auth::user()->id)
                                            <button class="btn btn-default" style="width: 100px;" onclick="edit()">Edit</button>
                                        @endif
                                    </div>
                                    <div class="col-xs-12 col-sm-10 col-md-9 col-lg-10">
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <h4 class="text-uppercase no-margin">
                                                    <strong>{{ $user->name }}</strong>
                                                </h4>
                                                <h4 class="no-margin">
                                                    <small><a href="#">{{ $user->email }}</a></small>
                                                </h4>
                                            </div>
                                            <h5 class="text-muted text-uppercase">Provider:</h5>
                                            <p>
                                                @if($user->provider == 'facebook')
                                                    Facebook
                                                @elseif($user->provider == 'twitter')
                                                    Twitter
                                                @elseif($user->provider == 'google')
                                                    Google Plus
                                                @endif
                                            </p>
                                            <h5 class="text-muted text-uppercase">COUNTRY:</h5>
                                            <p id="location-info">
                                                @if(!is_null($user->userDetails))
                                                    {{ $user->userDetails->location }}
                                                @else
                                                    ...
                                                @endif
                                            </p>
                                            <h5 class="text-muted text-uppercase">MINI BIOGRAPHY:</h5>
                                            <p id="biography-info">
                                                @if(!is_null($user->userDetails))
                                                    {{ $user->userDetails->biography }}
                                                @else
                                                    ...
                                                @endif
                                            </p>
                                            <h5 class="text-muted text-uppercase">Social links:</h5>
                                            <p id="socials-info">
                                                @if(!is_null($user->userDetails))
                                                    @if(!is_null( $user->userDetails->facebook ))
                                                        <a href="{{ $user->userDetails->facebook }}">
                                                            <i class="fa fa-facebook btn btn-default btn-xs"></i>
                                                        </a>
                                                    @endif
                                                    @if(!is_null( $user->userDetails->twitter ))
                                                        <a href="{{ $user->userDetails->twitter }}">
                                                            <i class="fa fa-twitter btn btn-default btn-xs"></i>
                                                        </a>
                                                    @endif
                                                    @if(!is_null( $user->userDetails->linkedIn ))
                                                        <a href="{{ $user->userDetails->linkedIn }}">
                                                            <i class="fa fa-linkedin btn btn-default btn-xs"></i>
                                                        </a>
                                                    @endif
                                                    @if(!is_null( $user->userDetails->googlePlus ))
                                                        <a href="{{ $user->userDetails->googlePlus }}">
                                                            <i class="fa fa-google-plus btn btn-default btn-xs"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    ...
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">

                                </div>
                            </div>

                            @if($user->id==Auth::user()->id)
                                <div id="profile-edit-form" class="col-xs-12 col-sm-12 col-md-8 col-lg-8 media">
                                    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-2 pull-left p-r-xs m-b-md">
                                        <img class="" src="{{ URL::asset($user->avatar) }}" height="100" width="100" alt="Қолданушы суреті">
                                    </div>
                                    <div class="col-xs-12 col-sm-10 col-md-9 col-lg-10">
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <h4 class="text-uppercase no-margin">
                                                    <strong>{{ $user->name }}</strong>
                                                </h4>
                                                <h4 class="no-margin">
                                                    <small><a href="#">{{ $user->email }}</a></small>
                                                </h4>
                                            </div>
                                            <h5 class="text-muted text-uppercase">Provider:</h5>
                                            <p>
                                                @if($user->provider == 'facebook')
                                                    Facebook
                                                @elseif($user->provider == 'twitter')
                                                    Twitter
                                                @elseif($user->provider == 'google')
                                                    Google Plus
                                                @endif
                                            </p>
                                            <form class="" id="edit-profile">
                                                <h5 class="text-muted text-uppercase">COUNTRY:</h5>
                                                <div class="form-group">
                                                    <input id="location" name="location" class="form-control" type="text" placeholder="Location" >
                                                </div>
                                                <h5 class="text-muted text-uppercase">MINI BIOGRAPHY:</h5>
                                                <div class="form-group">
                                                    <textarea id="biography" name="about" rows="6" class="form-control" placeholder="Small information..." ></textarea>
                                                </div>
                                                <h5 class="text-muted text-uppercase">Social links:</h5>
                                                <div class="form-group">
                                                    <input id="facebook" name="facebook" class="form-control" type="text" placeholder="Facebook" >
                                                    <input id="twitter" name="twitter" class="form-control" type="text" placeholder="Twitter" >
                                                    <input id="linkedIn" name="linkedIn" class="form-control" type="text" placeholder="LinkedIn" >
                                                    <input id="googlePlus" name="googlePlus" class="form-control" type="text" placeholder="Google Plus" >
                                                </div>
                                                <p id="profile-post-result" class="text-danger"></p>
                                                <div class="form-group">
                                                    <button class="btn btn-info pull-right" type="submit">Save</button>
                                                    <button class="btn btn-info pull-right m-r-sm" type="button" onclick="cancel()">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        $('#profile-edit-form').hide();

        function edit(){
            $('#profile-info').hide();
            $('#profile-edit-form').show();

            @if(!is_null(Auth::user()->userDetails))
                $('#biography').val('{{Auth::user()->userDetails->biography}}');
                $('#location').val('{{Auth::user()->userDetails->location}}');
                $('#facebook').val('{{Auth::user()->userDetails->facebook}}');
                $('#twitter').val('{{Auth::user()->userDetails->twitter}}');
                $('#linkedIn').val('{{Auth::user()->userDetails->linkedIn}}');
                $('#googlePlus').val('{{Auth::user()->userDetails->googlePlus}}');
            @endif
        }

        function cancel(){
            $('#profile-edit-form').hide();
            $('#profile-info').show();

            $('#biography').val('');
            $('#location').val('');
            $('#facebook').val('');
            $('#twitter').val('');
            $('#linkedIn').val('');
            $('#googlePlus').val('');
        }

        $('#edit-profile').submit( function (event) {
            event.preventDefault();
            var biography = $('#biography').val(),
                    location_user = $('#location').val(),
                    facebook = $('#facebook').val(),
                    twitter = $('#twitter').val(),
                    linkedIn = $('#linkedIn').val(),
                    googlePlus = $('#googlePlus').val();
            console.log('Submitted');
            if(biography && location_user) {
                $.ajax({
                    url: '{{ url('/profile') }}',
                    type: 'post',
                    data: {
                        biography: biography,
                        location: location_user,
                        facebook: facebook,
                        twitter: twitter,
                        linkedIn: linkedIn,
                        goolePlus: googlePlus
                    },
                    success: function (response) {
                        if(response.message_type == 'success'){
                            $('#profile-post-result').removeClass().addClass('text-success').text(response.message);
                        }
                        setTimeout(function () {
                            $("#profile-post-result").html('');
                            location.reload();
                        }, 3000);
                    }
                });
            }else{
                $('#profile-post-result').removeClass().addClass('text-danger').text("Қолданушы мәліметтерін енгізіңіз.");
            }
        });
    </script>
@endsection