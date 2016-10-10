@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">

    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Default Style</h4>
            </div>
            <div class="panel-body">
                <form action="/" method="POST">
                    <fieldset>
                        <legend>Legend</legend>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" /> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Login</button>
                        <button type="submit" class="btn btn-sm btn-default">Cancel</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection