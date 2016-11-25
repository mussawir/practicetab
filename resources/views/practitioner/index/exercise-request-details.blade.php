@extends('layouts.pradash')
@section('content')
@section('sidebar')
@include('layouts.pradash-sidebar')
@endsection
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Exercise Request Detail<small></small></h1>
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
                <h4 class="panel-title">Exercise Request Detail</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="pull-left"><b>Requested On:</b> {{$exercise->created_at}}</p>
                        <hr>
                        @foreach($sup_requests as $sr)
                        <h5><b>Patient Name:</b></h5>
                        <h5>{{ $sr->first_name . ' ' . $sr->last_name}}</h5>
                        @endforeach
                        <hr>
                        <h5><b>Request Title:</b></h5>
                        <h5>{{$exercise->title}}</h5>
                        <hr>
                        <h5><b>Message:</b></h5>
                        <h5>{!! $exercise->message !!}</h5>
                        <hr>
                        {!! Form::open(array('url'=>'practitioner/index/exercise-approved/'.$exercise->er_id,'class'=>'pull-left')) !!}
                        {!! Form::submit('Approve', array('class'=>'btn btn-success')) !!}
                        {!! Form::close() !!}
                        {!! Form::open(array('url'=>'practitioner/index/exercise-reject/'.$exercise->er_id,'class'=>'pull-left','style'=>'position:relative;left:5px;')) !!}
                        {!! Form::submit('Reject', array('class'=>'btn btn-danger')) !!}
                        {!! Form::close() !!}
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
                <h4 class="panel-title">List of Requested Exercise</h4>
            </div>
            <div class="panel-body">
                <table id="dt-cnt-list" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
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