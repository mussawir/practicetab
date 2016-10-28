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
    <h1 class="page-header">Suggestions <small>Nutrition Suggestions</small></h1>
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

        {!! Form::open(array('url'=>'/practitioner/suggestion/confirm-nutrition-suggestions', 'id'=>'frm-suggestions')) !!}
        <div class="col-md-12" style="margin-bottom: 10px;">
            {!! Form::submit('Next >>', array('class'=>'btn btn-success pull-right')) !!}
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Select Nutrition For Recommendation
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="dt-nut" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Usability</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nutrition as $item)
                            <tr>
                                <td>
                                    @if(isset($item->main_image) && (!empty($item->main_image)))
                                        <img src="{{asset('public/dashboard/img/nutrition/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 64px;" />
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->usability}}</td>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="nut_id[]" value="{{$item->nut_id}}">
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
                    <table class="table table-striped table-hover" id="dt-patient">
                        <thead>
                        <tr>
                            <th>Patient</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->full_name}}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="pa_id[]" value="{{$patient->pa_id}}">
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
        {!! Form::close() !!}
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {

            if ($('#dt-nut').length !== 0) {
                $('#dt-nut').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }

            $('#dt-patient').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
            });

        }); // ready function end

        $('#frm-suggestions').submit(function () {
            if ($('[name="nut_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one nutrition.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }

            if ($('[name="pa_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one patient.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection