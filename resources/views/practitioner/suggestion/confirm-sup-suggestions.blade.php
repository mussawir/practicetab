@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
        <li class="active">Suggestions</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Suggestions <small>Send suggestions to selected patients</small></h1>
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

        {!! Form::open(array('url'=>'/practitioner/suggestion/saveSupplementSuggestions', 'id'=>'frm-suggestions')) !!}
        <div class="col-md-10" style="margin-bottom: 10px;">
            <textarea name="message" class="form-control" rows="3" placeholder="Enter your message" required></textarea>
        </div>
        <div class="col-md-2">
            {!! Form::submit('Send', array('class'=>'btn btn-success form-control')) !!}
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Selected Supplements
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="dt-sup" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Used For</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supplements as $item)
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
                                    <input type="hidden" name="sup_id[]" value="{{$item->sup_id}}" />
                                    <a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '{{$item->sup_id}}')"><i class="fa fa-times"></i> Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Selected Patients
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-hover" id="dt-patient">
                        <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{$patient->full_name}}</td>
                                <td>
                                    <input type="hidden" name="pa_id[]" value="{{$patient->pa_id}}" />
                                    <a href="javascript:void(0);" class="text-danger" onclick="removeRow(this, '{{$patient->pa_id}}')"><i class="fa fa-times"></i> Remove</a>
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
            $.get("{{url('/practitioner/suggestion/removeSelectedPatient')}}", { s_pa_id: id }, function(data) {
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
            $.get("{{url('/practitioner/suggestion/removeSelectedSup')}}", { sup_id: id }, function(data) {
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