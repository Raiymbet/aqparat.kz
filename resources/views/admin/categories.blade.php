@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading hbuilt">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Админ</a></li>
                        <li class="active">
                            <span>Санаттар</span>
                        </li>
                    </ol>
                </div>

                <div class="panel-body">
                    <div class="col-lg-6">
                        <table class="table table-bordered table-hover" id="category_list">
                            @foreach($categories as $category)
                                <tr id="{{$category->id}}">
                                    <td>
                                        <span id="span_{{$category->id}}">{{ $category->name }}</span>
                                    </td>
                                    <td>
                                        <span id="span_category_type_{{$category->id}}">{{ $category->type }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-sm btn-default" onclick="delete_category('{{$category->id}}')">Өшіру</button>
                                            <button class="btn btn-sm btn-default" onclick="edit_category('{{$category->id}}', $('#span_{{$category->id}}').text(), $('#span_category_type_{{$category->id}}').text())">Өзгерту</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <form id="add_category" style="">
                            <div class="form-group">
                                <input id="category_name" class="form-control" type="text" name="name" placeholder="Санатты енгізіңіз..." value=""/>
                            </div>
                            <div class="form-group">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="add_category_type" id="option1" value="simple" autocomplete="off" checked>Simple
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="add_category_type" id="option2" value="point" autocomplete="off">Point
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="add_category_type" id="option3" value="focus" autocomplete="off">Focus
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-info" name="submit">Қосу</button>
                        </form>

                        <form id="edit_category" style="display:none">
                            <div class="form-group">
                                <input id="edit_category_id" type="hidden" value="" />
                                <input class="form-control" id="edit_category_name" type="text" name="name" value="" />
                            </div>
                            <div class="form-group">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="edit_category_type" value="simple" id="option1" autocomplete="off" checked>Simple
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="edit_category_type" value="point" id="option2" autocomplete="off">Point
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="edit_category_type" value="focus" id="option3" autocomplete="off">Focus
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-info" name="submit">Өзгерту</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function delete_category(id){
            $.get('{{ url('/admin/categories/delete') }}'+'/'+id, function(data) {
                if(data=="OK"){
                    swal("Өшірілді!", "Санат сәтті өшірілді.", "success");
                    var target = $("#"+id);
                    target.hide('slow', function(){ target.remove(); });
                }
            });
        }

        function show_form(form_id){
            $("form").hide();
            $('#'+form_id).show("slow");
        }

        function edit_category(id, name, type){
            $("#edit_category_id").val(id);
            $("#edit_category_name").val(name);
            //console.log(type);
            $('input[name="edit_category_type"]').each( function () {
                //console.log("Each "+$(this).val());
                if($(this).val()==type){
                    $(this).checked = true;
                }else{
                    $(this).checked = false;
                }
            });
            show_form('edit_category');
        }

        $('#add_category').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var name = $('#category_name').val(),
                type = $('input[name="add_category_type"]:checked').val();
            //console.log(type);

            if(name){
                //ajax post the form
                $.post("{{url('/admin/categories')}}", {
                    name: name,
                    type: type
                }).done(function(data) {
                    //$('#add_category').hide("slow");
                    //swal("Сәтті жұмыс!", data, "success");
                    swal({
                        title: "Сәтті жұмыс!",
                        text: data,
                        type: "success",
                    },
                    function(){
                        location.reload();
                    });
                });

            }else{
                swal("Oops...", "Санат атын енгізіңіз.", "error");
            }
        });

        $('#edit_category').submit(function() {
            /* stop form from submitting normally */
            event.preventDefault();

            var category_id = $('#edit_category_id').val();
            var name = $('#edit_category_name').val(),
                    type = $('input[name="edit_category_type"]:checked').val();
            //console.log(type);

            var current_name = $("#span_"+category_id).text(),
                    current_type = $("#span_category_type_"+category_id).text();
            var new_name = current_name.replace(current_name, name),
                    new_type = current_type.replace(current_type, type);
            if(name){
                //ajax post the form
                $.post("{{url('/admin/categories/edit')}}"+'/'+category_id, {
                    name: name,
                    type: type
                }).done(function(data){
                    swal("Сәтті жұмыс!", data, "success");
                    $("#span_"+category_id).text(new_name);
                    $("#span_category_type_"+category_id).text(new_type);
                    show_form('add_category');
                });
            }else{
                swal("Oops...", "Санат атын енгізіңіз.", "error");
            }
        });
    </script>
@endsection