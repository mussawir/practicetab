@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Email Group</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Group <small>Confirmation</small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12 msg">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::pull('success')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{Session::pull('error')}}</strong>
                <span class="close" data-dismiss="alert">×</span>
            </div>
        @endif
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">New Email Group</h4>
        </div>
        <div class="panel-body">
            {!! Form::open(array('url'=>'/practitioner/email-group/store', 'id'=>'frm-suggestions')) !!}
            <div class="col-md-10" style="margin-bottom: 10px;">
                <h5>Email Group Name:</h5>
                <p>{{ Session::get('group_name') }}</p>
                <h5>Email Group Descrption:</h5>
                <p>{{ Session::get('group_desc') }}</p>
            </div>
            <div class="col-md-2">
                {!! Form::submit('Create Email Group', array('class'=>'btn btn-success form-control')) !!}
            </div>

            <div class="col-md-6">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Selected Email</h4>
                    </div>
                    <div class="panel-body">
                        <table id="dt-sup" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patients as $item)
                                <tr>
                                    <td>{{$item->first_name. " " . $item->last_name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <input type="hidden" name="sup_id[]" value="{{$item->user_id}}" />
                                        <a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '{{$item->user_id}}')"><i class="fa fa-times"></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Selected Contacts</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover" id="dt-patient">
                            <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Email</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->first_name. " ". $contact->last_name}}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <input type="hidden" name="pa_id[]" value="{{$contact->cnt_id}}" />
                                        <a href="javascript:void(0);" class="text-danger" onclick="removeRow(this, '{{$contact->cnt_id}}')"><i class="fa fa-times"></i> Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
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

            if ($('#dt-patient').length !== 0) {
                $('#dt-patient').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
                });
            }
        });

        function removeRow(elm, id) {
            $.get("{{url('/practitioner/suggestion/removeContacts')}}", { user_id: id }, function(data) {
                if(data == 'success'){
                    $(elm).closest('tr').remove();

                    var rowCount = $('#dt-patient tbody tr').length;
                    if(rowCount==0) {
                        $("#dt-patient tbody").append('<tr id="pa-empty-row" class="odd"><td valign="top" colspan="2" class="dataTables_empty">No data available in table</td></tr>');
                    }
                }
            });
            return false;
        }


        function removeSupRow(elm) {
            $(elm).closest('<tr>').remove();

            var rowCount = $('#dt-sup tbody tr').length;
            if(rowCount==0) {
                $("#dt-sup tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>');
            }

                    function removeSupRow(elm, id) {
                        $.get("{{url('/practitioner/suggestion/removePatients')}}", { user_id: id }, function(data) {
                            if(data == 'success') {
                                $(elm).closest('tr').remove();
                                var rowCount = $('#dt-sup tbody tr').length;
                                if (rowCount == 0) {
                                    $("#dt-sup tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>');
                                }
                            }
                        });
                        return false;
                    }

            $('#frm-suggestions').submit(function () {
                if($('#dt-sup').find('td').hasClass('dataTables_empty')){
                    $('.msg').html('<div class="alert alert-warning"><strong>Please add supplement(s).</strong></div>').show().delay(5000).hide('slow');
                    return false;
                }

                if($('#dt-patient').find('td').hasClass('dataTables_empty')){
                    $('.msg').html('<div class="alert alert-warning"><strong>Please add patient(s).</strong></div>').show().delay(5000).hide('slow');
                    return false;
                }
            });
    </script>
@endsection