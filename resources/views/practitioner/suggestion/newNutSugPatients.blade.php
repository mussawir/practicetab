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

    {!! Form::open(array('url'=>'/practitioner/suggestion/addNutPatients', 'id'=>'frm-suggestions','data-parsley-validate' => 'true')) !!}
    <div class="col-md-6" style="margin-top: 44px;">

        <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Select Patients For Recommendation
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
                                        <input type="checkbox" name="pa_id[]" data-parsley-required="true" value="{{$patient->user_id}}" {{in_array($patient->user_id, $patient_ids)? 'checked="checked"' : ''}}>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr/>
                {!! Form::submit('Add to list', array('class'=>'btn btn-success pull-right')) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    {{--{!! Form::open(array('url'=>'/practitioner/suggestion/confirm-supplement-suggestions', 'id'=>'frm-suggestions')) !!}--}}
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
                {{--{!! Form::submit('Select Patient(s) >>', array('class'=>'btn btn-success pull-right')) !!}--}}
                <button type="button" id="btn-next" class="btn btn-success pull-right">Next >></button>
            </div>
        </div>
        <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Selected Patients
                </h4>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover" id="dt-pat-selected">
                    <thead>
                    <tr>
                        <th>Patient</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selected_patients as $patient)
                        <tr>
                            <td>{{$patient->full_name}}</td>
                            <td>
                                {{--<input type="hidden" name="pa_id[]" value="{{$patient->pa_id}}" />--}}
                                <a href="javascript:void(0);" class="text-danger" onclick="removePatRow(this, '{{$patient->user_id}}')"><i class="fa fa-times"></i> Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--{!! Form::close() !!}--}}
</div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        var tblPatient = '';
        $(function () {
            tblPatient = $('#dt-patient').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
            });

            $('#dt-pat-selected').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
            });

        }); // ready function end

        function removePatRow(elm, id) {
            $.get("{{url('/practitioner/suggestion/removeNutPatient')}}", { nut_pat_id: id }, function(data) {
                $('#page-loader').removeClass('hide');
                if(data == 'success'){
                    /*$(elm).closest('tr').remove();

                     var rowCount = $('#dt-pat-selected tbody tr').length;
                     if(rowCount==0) {
                     $("#dt-pat-selected tbody").append('<tr id="pa-empty-row" class="odd"><td valign="top" colspan="2" class="dataTables_empty">No data available in table</td></tr>');
                     }*/
                    window.location.reload();
                }
                $('#page-loader').addClass('hide');
            });
            return false;
        }

        $('#btn-next').click(function () {
            if($('#dt-pat-selected').find('td').hasClass('dataTables_empty')){
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one patient.</strong></div>').show().delay(5000).hide('slow');
                return false;
            } else {
                window.location.assign('{{url('/practitioner/suggestion/confirm-nutrition-suggestions')}}');
            }
        });

        $("#frm-suggestions").on('submit', function(e){

            var supChkCount = 0;

            // Iterate over all checkboxes in the table
            tblPatient.$('input[name="pa_id[]"]').each(function(){
                // If checkbox doesn't exist in DOM
                if(!$.contains(document, this)){
                    // If checkbox is checked
                    if(this.checked){
                        // Create a hidden element
                        $("#frm-suggestions").append(
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
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one patient.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection