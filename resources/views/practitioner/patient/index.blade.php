@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Patients</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Patients <small></small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
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
                <h4 class="panel-title">Patients List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Prescribe</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table1 as $item)
                        <tr>
                            <td>
                                @if(isset($item->photo) && (!empty($item->photo)))
                                    <img src="{{asset('public/practitioners/'.$directory.'/'.$item->photo)}}" alt="{{$item->photo}}" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$item->photo}}" />
                                @endif
                            </td>
                            <td>{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</td>
                            <td>
                                <a href="{{url('/practitioner/supplement-prescription/add-master/'.$item->pa_id)}}"><i class="fa fa-medkit"></i> Supplements</a>
                                |
                                <a href="{{url('/practitioner/nutrition-prescription/add-master/'.$item->pa_id)}}"><i class="fa fa-fire"></i> Nutrition</a>
                                |
                                <a href="{{ url('/practitioner/exercise-prescription/add-master/'.$item->pa_id) }}"><i class="fa fa-heart-o"></i> Exercises</a>
                            </td>

                            <td>
                                <a href="{{url('/practitioner/patient/edit/'.$item->pa_id)}}"><i class="fa fa-pencil"></i> Edit</a> |
                                <a href="{{url('/practitioner/patient/files/'.$item->pa_id)}}"><i class="fa fa-file"></i> Files</a> |
                                <a href="javascript:void(0);" onclick="doDelete('{{$item->pa_id}}', this);"><i class="fa fa-trash-o"></i> Block</a>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">

        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this manufacturer?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/admin/execategories/destroy') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                            $(elm).closest('tr').fadeOut();
                            $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                        } else {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }*/
                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }

        function addMaster(id, elm)
        {
            var q = confirm("Click OK to proceed, it will create a new exercise prescription. You can add one or more exercises");
            if (q == true) {
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/practitioner/exercise-prescription/add-master') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {

                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
    </script>
@endsection