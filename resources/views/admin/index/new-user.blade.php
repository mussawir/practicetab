@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Users</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Users <small>Create New User</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <div class="col-md-12 msg">
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
    {!! Form::open(array('url'=>'/admin/index/saveUser', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true'
)) !!}
    <!-- begin col-8 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Create New User</h4>
            </div>
            <div class="panel-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('first_name','First Name *:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First Name', 'data-parsley-required'=>'true')) !!}
                            </div>
                            @if ($errors->has('first_name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('last_name','Last Name:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email','Email *:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=> 'Email', 'data-parsley-required'=>'true', 'data-parsley-type'=>'email')) !!}
                            </div>
                            @if ($errors->has('email'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('primary_phone','Phone *:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('primary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Phone', 'data-parsley-required'=>'true')) !!}
                            </div>
                            @if ($errors->has('primary_phone'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('cell','Cell:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('cell', null, array('class'=>'form-control', 'placeholder'=> 'Cell')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('address','Address :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::textarea('address', null, array('class'=>'form-control', 'placeholder'=> 'Address', 'rows'=>'3')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 8 -->
    <!-- begin col-4 -->
    <!-- end col 4 -->
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
                });
            }
        });


    </script>
@endsection