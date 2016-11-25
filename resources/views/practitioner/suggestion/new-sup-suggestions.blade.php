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

        {!! Form::open(array('url'=>'/practitioner/suggestion/confirm-supplement-suggestions', 'id'=>'frm-suggestions','data-parsley-validate' => 'true')) !!}
        <div class="col-md-12" style="margin-bottom: 10px;">
            {!! Form::submit('Next >>', array('class'=>'btn btn-success pull-right')) !!}
            <button type="button" style="margin-right: 20px;" class="btn btn-info pull-right" onclick="window.location.href='{{url('/practitioner/suggestion/clearSupSugSessions')}}'">Reset</button>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Select supplements For Recommendation
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
                                            <input type="checkbox" name="sup_id[]" data-parsley-required="true"
                                                   value="{{$item->sup_id}}" {{in_array($item->sup_id, $selected_sup)? 'checked="checked"' : ''}}>
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
                                        <input type="checkbox" name="pa_id[]" value="{{$patient->pa_id}}" {{in_array($patient->pa_id, $selected_patients)? 'checked="checked"' : ''}}>
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
        var dtSupTable = '';
        var dtPatientTable = '';

        $(function () {
            dtSupTable = $('#dt-sup').DataTable({
                responsive: true,
                "aaSorting": [[1, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
            });

            dtPatientTable = $('#dt-patient').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
            });

        }); // ready function end

        /*$('#frm-suggestions').submit(function () {
            if ($('[name="sup_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }

            if ($('[name="pa_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one patient.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });*/

        $("#frm-suggestions").on('submit', function(e){

            var supChkCount = 0;

            // Iterate over all checkboxes in the table
            dtSupTable.$('input[name="sup_id[]"]').each(function(){
                // If checkbox doesn't exist in DOM
                if(!$.contains(document, this)){
                    // If checkbox is checked
                    if(this.checked){
                        // Create a hidden element
                        $(this).append(
                                $('<input>')
                                        .attr('type', 'hidden')
                                        .attr('name', this.name)
                                        .val(this.value)
                        );
                    }
                }

                if(this.checked){
                    supChkCount = supChkCount+1;
                }
            });

            if(supChkCount==0){
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection