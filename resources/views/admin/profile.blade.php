@extends('layouts.admin')

@section('content')
    <div class="row">
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
                            <img src="{{ URL::asset('img/p1.jpg') }}" class="img-responsive">
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="hpanel hgreen">
                        <div class="panel-body"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection