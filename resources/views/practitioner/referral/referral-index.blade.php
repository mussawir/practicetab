@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/referral')}}">Referral Program</a></li>
    <li class="active">Resend</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>Re-send invitation to Practitioner(s)</small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-10">
        <div class="alert alert-info"><strong>Invite as many Practitioners as you wish to PracticeTabs and receive $75 per Premium-Plan sign ups</strong></div>
    </div>
    <div class="col-md-2">
        <button type="button" id="btn-resend" class="btn btn-success form-control">Re-send Invitation</button>
    </div>
</div>
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <div class="msg">
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
        </div>
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Practitioners List</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/referral/resend-invitation', 'id'=>'frm-resend')) !!}
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Invitations</th>
                        <th>Last Invitation At</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$item->first_name.' '.$item->last_name}} </td>
                            <td>{{$item->phone}} </td>
                            <td>{{$item->email}} </td>
                            <td>@if($item->is_paid==0)
                                    Free
                                @else
                                    Paid
                                @endif
                            </td>
                            <td class="text-center"><span class="badge badge-danger">{{$item->invitation_count}}</span></td>
                            <td>{{date('m/d/Y H:i:s', strtotime($item->last_invite_at))}}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="id[]" value="{{$item->id}}">
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        var table = '';
        $(document).ready(function() {
            if ($('#data-table').length !== 0) {
                table = $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [7]}]
                });
            }
        });

        $('#btn-resend').click(function () {
            var chkCount = 0;

            // Iterate over all checkboxes in the table
            table.$('input[type="checkbox"]').each(function(){
                // If checkbox doesn't exist in DOM
                if(!$.contains(document, this)){
                    // If checkbox is checked
                    if(this.checked){
                        // Create a hidden element
                        $('#frm-resend').append(
                                $('<input>')
                                        .attr('type', 'hidden')
                                        .attr('name', this.name)
                                        .val(this.value)
                        );
                    }
                }

                if(this.checked){
                    chkCount = chkCount+1;
                }
            });

            if(chkCount==0){
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one practitioner before proceed.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }

            $('#frm-resend').submit();
        });
    </script>
@endsection