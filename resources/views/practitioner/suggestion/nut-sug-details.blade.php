@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/suggestion/nutrition-suggestions-list')}}">Nutrition List</a></li>
    <li class="active">Suggested Nutrition Details</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Suggested Nutrition Details<small></small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <h3>Practitioner: {{$list->pra_fullname}}</h3>
            <h4>Message: {{$list->message}}</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Nutrition List</h4>
            </div>
            <div class="panel-body">
                <table id="dt-nut-sug" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Usability</th>
                        <th>Description</th>
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
                            <td>{{$item->short_description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Patients</h4>
            </div>
            <div class="panel-body">
                <table id="dt-patients" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $item)
                        <tr>
                            <td>
                                @if(isset($item->photo) && (!empty($item->photo)))
                                    <img src="{{asset('public/practitioners/'.$directory.'/'.$item->photo)}}" alt="" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="" />
                                @endif
                            </td>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->primary_phone}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#dt-nut-sug').length !== 0) {
                $('#dt-nut-sug').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                    //"aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            if ($('#dt-patients').length !== 0) {
                $('#dt-patients').DataTable({
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