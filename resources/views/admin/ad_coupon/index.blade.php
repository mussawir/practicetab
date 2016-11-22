@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Coupon</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Coupon <small></small></h1>
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
                <h4 class="panel-title">Coupons List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Discount</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon as $item)
                        <tr>
                            <td>
                                @if(isset($item->cFile) && (!empty($item->cFile)))
                                    <img src="{{asset('public/dashboard/img/coupon/'.$item->cFile)}}" alt="{{$item->cCode}}" class="img-responsive" style="max-height: 100px;" />
                                @else
                                    <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->cCode}}" />
                                @endif
                            </td>
                            <td>{{$item->cCode}}</td>
                            <td>{{$item->cTitle}}</td>
                            <td>{{$item->cDescription}}</td>
                            <td>{{$item->discount}}</td>
                            <td>{{$item->expiryDate}}</td>
                            <td>
                                {{$item->Status}}
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
    </script>
@endsection