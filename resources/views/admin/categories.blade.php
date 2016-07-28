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
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-sm btn-default" onclick="delete_category('{{$category->id}}')">Өшіру</button>
                                            <button class="btn btn-sm btn-default" onclick="edit_category('{{$category->id}}', $('#span_{{$category->id}}').text())">Өзгерту</button>
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
                            <button class="btn btn-sm btn-info" name="submit">Қосу</button>
                        </form>

                        <form id="edit_category" style="display:none">
                            <div class="form-group">
                                <input id="edit_category_id" type="hidden" value="" />
                                <input class="form-control" id="edit_category_name" type="text" name="name" value="" />
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

        function edit_category(id,name){
            $("#edit_category_id").val(id);
            $("#edit_category_name").val(name);
            show_form('edit_category');
        }

        $('#add_category').submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            var name = $('#category_name').val();
            if(name){
                //ajax post the form
                $.post("{{url('/admin/categories')}}", {name: name}).done(function(data) {
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
            var name = $('#edit_category_name').val();
            var current_name = $("#span_"+category_id).text();
            var new_name = current_name.replace(current_name, name);
            if(name){
                //ajax post the form
                $.post("{{url('/admin/categories/edit')}}"+'/'+category_id, {name: name}).done(function(data){
                    swal("Сәтті жұмыс!", data, "success");
                    $("#span_"+category_id).text(new_name);
                    show_form('add_category');
                });
            }else{
                swal("Oops...", "Санат атын енгізіңіз.", "error");
            }
        });
    </script>
@endsection