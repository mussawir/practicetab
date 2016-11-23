@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Sent Details</li>
</ol><!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Campaign Details<small></small></h1>
<!-- end page-header -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Details</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="pull-left"><b>Starts On:</b> {{$data->start_date}}</p>
                        <p  class="pull-right"><b>Ends On:</b> {{$data->end_date}}</p>
                        <div class="clearfix"></div>
                        <h5><b>Campaign Status:</b>
                            <?php
                            if($data->status == 0){
                                echo ' <i class="fa fa-circle" aria-hidden="true" style="color:orange"> Pending</i> ';
                            }elseif($data->status == 1){
                                echo ' <i class="fa fa-circle" aria-hidden="true" style="color:greenyellow"> Running</i> ';
                            }elseif($data->status == 2){
                                echo ' <i class="fa fa-circle" aria-hidden="true" style="color:red"> Finished</i> ';
                            }
                            ?>
                        </h5>
                        <hr>
                        <h5><b>Campaign Name:</b></h5>
                        <h5>{{$data->campaign_name}}</h5>
                        <hr>
                        <h5><b>Recipent Group:</b></h5>
                        <h5>{!! $data->group_name !!}</h5>
                        <hr>
                        <h5><b>Campaign Body:</b></h5>
                        <h5>{!! $data->message !!}</h5>

                    </div>
                </div>
                <div style="width:50px;height:50px";></div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">List of Campaign Recipents</h4>
            </div>
            <div class="panel-body">
                <table id="dt-cnt-list" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->first_name. " ". $contact->last_name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->primary_phone}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> </div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#dt-cnt-list').length !== 0) {
                $('#dt-cnt-list').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                    //"aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }


        });
    </script>
@endsection