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
<h1 class="page-header">New Email Group <small>Add Contacts</small></h1>
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

    {!! Form::open(array('url'=>'/practitioner/email-group/addContacts', 'id'=>'frm-suggestions', 'data-parsley-validate' => 'true')) !!}
    <div class="col-md-6" style="margin-top: 44px;">
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Add Contacts to List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contact as $item)
                        <tr>
                            <td>{{$item->first_name. " ". $item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" data-parsley-required="true" name="sup_id[]" value="{{$item->cnt_id}}" {{in_array($item->cnt_id, $con_ids)? 'checked="checked"' : ''}}>
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
                <button type="button" id="btn-next" class="btn btn-success pull-right">Next</button>
            </div>
        </div>
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
                <table id="selected-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selected_con as $item)
                        <tr>
                            <td>{{$item->first_name. " ". $item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                {{--<input type="hidden" name="sup_id[]" value="{{$item->sup_id}}" />--}}
                                <a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '{{$item->cnt_id}}')"><i class="fa fa-times"></i> Remove</a>
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
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
            if ($('#selected-table').length !== 0) {
                $('#selected-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                    //"aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }
        });// ready function end

        function removeSupRow(elm, id) {
            $.get("{{url('/practitioner/email-group/removeContacts')}}", { user_id: id }, function(data) {
                $('#page-loader').removeClass('hide');
                if(data == 'success') {
//                    $(elm).closest('tr').remove();

                     var rowCount = $('#selected-table tbody tr').length;
                     if (rowCount == 0) {
                     $("#selected-table tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>');
                     }
                    window.location.reload();
                }
                $('#page-loader').addClass('hide');
            });
            return false;
        }

        $('#btn-next').click(function () {
            if($('#selected-table').find('td').hasClass('dataTables_empty')){
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one patients.</strong></div>').show().delay(5000).hide('slow');
                return false;
            } else {
                window.location.assign('{{url('/practitioner/email-group/confirmed')}}');
            }
        });

        $("#frm-suggestions").on('submit', function(e){

            var supChkCount = 0;

            // Iterate over all checkboxes in the table
            dtSupTable.$('input[name="sup_id[]"]').each(function(){
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
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection