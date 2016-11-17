@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Supplements</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Supplements <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12 ">
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
                <h4 class="panel-title">Supplements List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Manufacturer</th>
                        <th>Name</th>
                        <th>Used For</th>
                        <th>Short Description</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplements as $item)
                        <tr>
                            <td>
                                @if(isset($item->main_image) && (!empty($item->main_image)))
                                    <img src="{{asset('public/dashboard/img/sup-img/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 100px;" />
                                @else
                                    <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                @endif
                            </td>
                            <td>{{$item->manufacName}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->used_for}}</td>
                            <td>{{$item->short_description}}</td>
                            <td>
                                <a href="{{url('/admin/supplements/edit/'.$item->sup_id)}}"><i class="fa fa-pencil"></i> Edit</a> |
                                <a  id="delete_{{$item->sup_id}}" href="javascript:void(0);" onclick="doDelete('{{$item->sup_id}}', this);"><i class="fa fa-trash-o"></i> Delete</a>
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
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,5]}]
                });
            }
        });

        function doDelete(id, elm)
        {
           // var q = confirm("Are you sure you want to delete this supplement?");
           // if (q == true)
            {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/admin/supplements/destroy') }}/' + id,
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
    </script>
@endsection