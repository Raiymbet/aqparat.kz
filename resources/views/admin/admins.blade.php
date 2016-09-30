@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Админдер</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <div class="pull-right">
                        <button class="btn btn-default btn-sm m-b m-r" onclick="show_form('add_admin');">Админ тіркеу</button>
                    </div>

                    <div class="col-lg-6">
                        <form id="add_admin" style="display:none">
                            <div class="form-group">
                                <input id="admin_name" class="form-control" type="text" name="name" placeholder="Аты-жөні" value=""/>
                            </div>
                            <div class="form-group">
                                <input id="admin_email" class="form-control" type="email" name="email" placeholder="Email" value=""/>
                            </div>
                            <div class="form-group">
                                <select id="admin_type" class="form-control" name="type">
                                    <option selected value="admin">Admin</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="columnist">Columnist</option>
                                    <option value="journalist">Journalist</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-info pull-right m-b" name="submit">Қосу</button>
                        </form>

                        <form id="edit_admin" style="display:none">
                            <div class="form-group">
                                <input id="edit_admin_id" type="hidden" value="" />
                                <input id="edit_admin_name" class="form-control" type="text" name="name" placeholder="Аты-жөні" value=""/>
                            </div>
                            <div class="form-group">
                                <input id="edit_admin_email" class="form-control" type="email" name="email" placeholder="Email" value=""/>
                            </div>
                            <div class="form-group">
                                <select id="edit_admin_type" class="form-control" name="type">
                                    <option selected value="admin">Admin</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="columnist">Columnist</option>
                                    <option value="journalist">Journalist</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-info pull-right m-b" name="submit">Өзгерту</button>
                        </form>
                    </div>

                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover" id="admins_list">
                            <thead>
                                <th>Аты-жөні</th>
                                <th>Электронды жәшігі</th>
                                <th>Дәрежесі</th>
                                <th>Амалдар</th>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr id="{{$admin->id}}">
                                        <td>
                                            <span id="span_name_{{$admin->id}}">{{ $admin->name }}</span>
                                        </td>
                                        <td>
                                            <span id="span_email_{{$admin->id}}">{{ $admin->email }}</span>
                                        </td>
                                        <td>
                                            <span id="span_type_{{$admin->id}}">{{ $admin->type }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-sm btn-default" onclick="delete_admin('{{$admin->id}}');">Өшіру</button>
                                                <button class="btn btn-sm btn-default" onclick="edit_admin('{{$admin->id}}',$('#span_name_{{$admin->id}}').text(),
                                                        $('#span_email_{{$admin->id}}').text(), $('#span_type_{{$admin->id}}').text());">Өзгерту</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="result-data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function delete_admin(id){
            $.get('{{ url('/admin/admins/delete') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal("Өшірілді!", "Қолданушы сәтті өшірілді.", "success");
                    var target = $("#"+id);
                    target.hide('slow', function(){ target.remove(); });
                }
            });
        }

        function hide_form() {
            $("form").hide();
        }

        function show_form(form_id){
            $("form").hide();
            $('#'+form_id).show("slow");
        }

        function edit_admin(id,name,email,type){
            $("#edit_admin_id").val(id);
            $("#edit_admin_name").val(name);
            $("#edit_admin_email").val(email);
            $("#edit_admin_type").val(type);
            show_form('edit_admin');
        }

        $('#add_admin').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var name = $('#admin_name').val();
            var email = $('#admin_email').val();
            var type = $('#admin_type').val();
            if(name && email && type){
                //ajax post the form
                $.post("{{url('/admin/admins')}}", {name: name, email:email, type:type}).done(function(data) {
                    //$('#add_category').hide("slow");
                    //swal("Сәтті жұмыс!", data, "success");
                    if(data.messageType == 'error'){
                        swal({
                            title: "Oops...",
                            text: data.message,
                            type: 'error'
                        });
                    }else if(data.messageType == 'success'){
                        swal({
                            title: "Сәтті жұмыс!",
                            text: data.message,
                            type: "success"
                        }, function(){
                            location.reload();
                        });
                    }else{
                        $('#result-data').html(data);
                    }
                });

            }else{
                swal("Oops...", "Админ мәліметтерін толықтырыңыз.", "error");
            }
        });

        $('#edit_admin').submit(function() {
            /* stop form from submitting normally */
            event.preventDefault();

            var admin_id = $('#edit_admin_id').val();
            var name = $('#edit_admin_name').val();
            var email = $('#edit_admin_email').val();
            var type = $('#edit_admin_type').val();

            var current_name = $("#span_name_"+admin_id).text(),
                    current_email = $("#span_email_"+admin_id).text(),
                    current_type = $("#span_type_"+admin_id).text();
            var new_name = current_name.replace(current_name, name),
                    new_email = current_email.replace(current_email, email),
                    new_type = current_type.replace(current_type, type);
            if(name && email && type){
                //ajax post the form
                $.post("{{url('/admin/admins/edit')}}"+'/'+admin_id, {name: name, email:email, type:type}).done(function(data){
                    swal("Сәтті жұмыс!", data, "success");
                    $("#span_name_"+admin_id).text(new_name);
                    $("#span_email_"+admin_id).text(new_email);
                    $("#span_type_"+admin_id).text(new_type);
                    hide_form();
                });
            }else{
                swal("Oops...", "Қолданушы мәліметтерін енгізіңіз.", "error");
            }
        });
    </script>
@endsection