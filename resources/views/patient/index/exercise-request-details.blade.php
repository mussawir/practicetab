@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/patient')}}">Dashboard</a></li>
    <li class="active">Exercise Request List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Exercise Request Detail<small></small></h1>
<!-- end page-header -->
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <p><b>Requested On:</b> {{$exercise->created_at}}</p>
            @foreach($sup_requests as $sr)
                <h5><b>Patient Name:</b> {{ $sr->first_name . ' ' . $sr->last_name}}</h5>
            @endforeach
            <h5><b>Request Title:</b> {{$exercise->title}}</h5>
            <h5><b>Message:</b> {!! $exercise->message !!}</h5>
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
                <h4 class="panel-title">List of Requested Exercise</h4>
            </div>
            <div class="panel-body">
                <table id="dt-cnt-list" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($sup_details as $srd)
                        <tr>
                            <td>
                                @if(isset($srd->image1) && (!empty($srd->image1)))
                                    <img src="{{asset('public/dashboard/img/exercise/'.$srd->image1)}}" alt="" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="" />
                                @endif
                            </td>
                            <td>{{$srd->heading}}</td>
                            <td>{{$srd->description}}</td>
                            <td>
                                <?php
                                if($srd->status == '0'){?>
                                    <span class="label label-warning">Unapproved</span>
                                <?php }elseif($srd->status == '1'){ ?>
                                <span class="label label-success">Approved</span>
                                <?php
                                }elseif($srd->status == '2'){ ?>
                                <span class="label label-danger">Rejected</span>
                                <?php
                                }
                                ?>

                            </td>

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