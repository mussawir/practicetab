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
    <h1 class="page-header">Suggestions <small>Supplement Suggestions</small></h1>
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

        {!! Form::open(array('url'=>'/practitioner/suggestion/confirm-supplement-suggestions', 'id'=>'frm-suggestions')) !!}

        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Select Supplements For Recommendation
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="dt-sup" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Used For</th>
                            <th></th>
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
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sup_id[]" value="{{$item->sup_id}}">
                                        </label>
                                    </div>
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
                        Suggest To Patients
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                    <div class="col-md-9">
                        <select id="patients" class="default-select2 form-control">
                            <option value="">Select Patient</option>
                            @foreach($patients as $item)
                                <option value="{{$item->pa_id}}">{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        {!! Form::submit('Next >>', array('class'=>'btn btn-success form-control')) !!}
                    </div>
                    </div>
                    <hr/>
                    <table class="table table-striped table-hover" id="dt-patient">
                        <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selected_patients as $patient)
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
        var patientTable = {};
        $(function () {
            $(".default-select2").select2();

            if ($('#dt-sup').length !== 0) {
                $('#dt-sup').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }

            patientTable = $('#dt-patient').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
            });

        }); // ready function end

        $('#patients').change(function () {
            var patientId = $(this).val();
            if(patientId > 0) {
                patientTable.destroy();

                patientTable = $('#dt-patient').DataTable({
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{url('/practitioner/suggestion/getSelectedPatient')}}',
                        data: function(d) {
                            d.id = patientId;
                        }
                    }
                });
            }
        });

        /*$('#dt-patient .dataTables_empty').closest('tr').remove();
         $("#dt-patient tbody").append(
         '<tr><input type="hidden" name="pa_id[]" value="'+patientId+'" />' +
         '<td>' + $("#patients option:selected").text() + '</td>' +
         '<td><a href="javascript:void(0);" class="text-danger" onclick="removeRow(this)"><i class="fa fa-times"></i> Remove</a></td>' +
         '</tr>'
         );*/

        function removeRow(elm, id) {
            $(elm).closest('tr').remove();

            var rowCount = $('#dt-patient tbody tr').length;
            if(rowCount==0) {
                $("#dt-patient tbody").append('<tr class="odd"><td valign="top" colspan="2" class="dataTables_empty">No data available in table</td></tr>');
            }

            $.get("{{url('/practitioner/suggestion/removeSelectedPatient')}}", { id: id }, function(data) {
                console.log(data);
            });
            return false;
        }

        $('#frm-suggestions').submit(function () {
            if ($('[name="sup_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection