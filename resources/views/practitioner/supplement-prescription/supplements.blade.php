@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/patient')}}">Patients</a></li>
    <li class="active">Supplements Prescription</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Prescribe supplements to {{ $table1->first_name }} {{ $table1->last_name }}</h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12 msg">
        @if(Session::has('success'))
            <div class="alert alert-success fade in">
                <strong>Success!</strong>
                <strong>{{Session::pull('success')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger fade in">
                <strong>Error!</strong>
                <strong>{{Session::pull('error')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @endif
            <div class="alert alert-danger fade in" id="errorLog" style="display: none">
            </div>
    </div>
</div>
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-7">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Supplements List</h4>
            </div>
            <div class="panel-body">
                <table id="dt-sup" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Used For</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table2 as $item)
                        <tr>
                            <td>
                                @if(isset($item->main_image) && (!empty($item->main_image)))
                                    <img src="{{asset('public/dashboard/img/sup-img/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->used_for}}</td>
                            <td>
                                <a onclick="callDialouge({{$item->sup_id}})" href="#"><i class="fa fa-plus"></i> Add</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->

    <div class="col-md-5">
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Selected Supplements</h4>
            </div>
            <div class="panel-body">
                <table id="dt-selected" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Used For</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sup_list as $item)
                        <tr>
                            <td>
                                @if(isset($item->main_image) && (!empty($item->main_image)))
                                    <img src="{{asset('public/dashboard/img/sup-img/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->used_for}}</td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="javascript:void(0);" onclick="doDeleteSupplement('{{$item->sup_id}}', this);" class="text-danger"><i class="fa fa-times fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <a id="print-link" href="#" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Prescribe &amp; Print</a>
                            &nbsp;
                            <a href="{{url('/practitioner/supplement-prescription/prescribe')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Prescribe</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#dt-sup').length !== 0) {
                $('#dt-sup').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }

            if ($('#dt-selected').length !== 0) {
                $('#dt-selected').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }
        }); // ready function end

        $('#print-link').click(function () {
            window.location.assign('{{url('/practitioner/patient')}}');
        });

        function doDeleteSupplement(id, elm)
        {
            $.ajax({
                    type: "DELETE",
                    url: '{{ url('/practitioner/supplement-prescription/delete') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        if (result.status == 'success') {
                            $(elm).closest('tr').remove();
                        } else {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
            });
            return false;
        }
        function saveNote()
        {
            var notes = $('#notes_'+$('#noteId').val()).val();
            $.ajax({
                type: "POST",
                url: '{{ url('/practitioner/supplement-prescription/storeNote') }}',
                data : {
                    sup_id :   $('#noteId').val(),
                    master_id : '',
                    notes : notes
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    if(result=='This supplement is already added')
                    {
                    var append = '<strong>Error!</strong>';
                    append+='<strong>'+result+'</strong>';
                    append+='<span class="close" data-dismiss="alert">×</span>';
                        $('#errorLog').html('');
                        $('#errorLog').html(append);
                        $("#errorLog").show();
                        setTimeout(function () {
                            $("#errorLog").hide();
                        }, 2000);
                    }else {
                        location.reload(true);
                    }
                },
                error:function (error) {
                    $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                }
            });
            $('#noteId').val('');
            $('#notes_'+$('#noteId').val()).val('');
            return false;
        }
        function callDialouge(id)
        {
            var ContentRender = '';
            var ContentFooter = '';
            ContentRender='<div class="form-group">';
            ContentRender+='<label for="notes" class="col-md-3 control-label">Notes *:</label>';
            ContentRender+='<div class="col-md-9">';
            ContentRender+='<input type="hidden" value= "'+id+'" id="noteId" />';
            ContentRender+='<textarea class="form-control" placeholder="Notes" required="required" name="notes" cols="50" rows="10" id="notes_'+id+'"></textarea>';
            ContentRender+='</div>';
            ContentRender+='</div>';
            ContentFooter='<br/>';
            ContentFooter+='<a onclick="saveNote();" href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal">Save</a>';
            ContentFooter+='<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>';
            showDialouge('content','Supplement Note',ContentRender,ContentFooter);
        }
        function showDialouge(renderIn,Title,Content,ModelFooter)
        {
            var render = '';
            render='<a id="reqDialouge_link" href="#modal-without-animation" class="btn btn-sm btn-default" data-toggle="modal">showDialouge</a>';
            render+='<div class="modal in" id="modal-without-animation" style="display: block; padding-right: 17px;">';
            render+='<div class="modal-dialog" id="reqDialouge">';
            render+='<div class="modal-content">';
            render+='<div class="modal-header">';
            render+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            render+='<h4 class="modal-title" id ="reqDial_title">'+Title+'</h4>';
            render+='</div>';
            render+='<div class="modal-body" id="reqDial_content">';
            render+=Content;
            render+='</br>';
            render+='</div>';
            render+='<div class="modal-footer" id="reqDia_footer">';
            render+=ModelFooter;
            //render+='<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>';
            render+='</div>';
            render+='</div>';
            render+='</div>';
            render+='</div>';
            if($("#reqDialouge").length == 0) {
                $('#'+renderIn).append(render);
                $('#reqDialouge_link').hide();
                $('#reqDialouge_link').click();
            }
            else
            {
                $('#reqDialouge_link').hide();
                $('#reqDial_title').text('');
                $('#modal-body').text('');
                $('#reqDial_title').text(Title);
                $('#modal-body').text(Content);
                $('#reqDia_footer').html('');
                $('#reqDia_footer').html(ModelFooter);
                $('#reqDialouge_link').click();
            }
            $('#reqDia_footer').css('border-top','0px');
        }
    </script>
@endsection