@extends('layouts.adash')

@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Practitioners</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Practitioners <small></small></h1>
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
                <h4 class="panel-title">Practitioner </h4>

            </div>
            @foreach($list as $item)
            <div class="panel-body">
                <h3>Personal Details </h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                @if(isset($item->photo) && (!empty($item->photo)))
                                    <img src="{{asset('public/practitioners/'. $item->directory .'/'.$item->photo)}}" alt="Practitioner Photo" class="img-responsive" style="max-height: 80px;" />
                                @else
                                    <img src="{{asset('public/img/no-user.jpg')}}" alt="Practitioner Photo" style="max-height: 80px;"/>
                                @endif
                                </div>
                                <div class="col-md-2">
                                    {{$item->first_name}} {{$item->last_name}}
                                </div>
                            </div>
                        </div>
            </div>
            @endforeach
        </div>
        <!-- end panel -->
    </div>
</div>
@endsection

@section('page-scripts')
    <script type="text/javascript">

    </script>
@endsection