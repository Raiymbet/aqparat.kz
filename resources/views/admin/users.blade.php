@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Қолданушылар тізімі</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="users_list">
                            <thead>
                            <th>Аты-жөні</th>
                            <th>Электронды жәшігі</th>
                            <th>Provider</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr id="{{$user->id}}">
                                    <td>
                                        <span id="span_name_{{$user->id}}">{{ $user->name }}</span>
                                    </td>
                                    <td>
                                        <span id="span_email_{{$user->id}}">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        <span id="span_type_{{$user->id}}">{{ $user->provider }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($users->hasMorePages())
                            <div class="pagination" style="clear: both; display: flex;">
                                <a class="btn btn-default center-block" href="{{ $users->nextPageUrl() }}">Load more...</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
    </script>
@endsection