@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/patient')}}">Patients</a></li>
    <li class="active">Prescribe Nutrition</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<div class="row">
    <div class="col-md-3">
        <h1 class="page-header">Add Nutrition:</h1>
    </div>
    <div class="col-md-1">
        @if(isset($table1->main_image) && (!empty($table1->main_image)))
            <img src="{{asset('public/dashboard/img/nutrition/'.$table1->main_image)}}" alt="{{$table1->name}}" class="img-responsive" style="max-height: 64px;" />
        @else
            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$table1->name}}" />
        @endif
    </div>
    <div class="col-md-8"><h1 class="page-header">{{$table1->name}}</h1></div>
</div>
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
                <h4 class="panel-title">For {{ $table2->first_name }} {{ $table2->last_name }}</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/nutrition-prescription/store', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                {!! Form::hidden('nut_id', $table1->nut_id) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('notes','Notes *:', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('notes', null, array('class'=>'form-control', 'placeholder'=> 'Notes', 'required'=> 'required')) !!}
                        </div>
                    </div>
                 </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('age','Age:', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::text('age', null, array('class'=>'form-control', 'placeholder'=> 'Age')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('weight','Weight:', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::text('weight', null, array('class'=>'form-control', 'placeholder'=> 'Weight (e.g: 5 g, 10 mg, 500 kcal, 3-5 oz., 2 tsp, 1 cups)')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('use','Use:', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::text('use', null, array('class'=>'form-control', 'placeholder'=> 'Use (e.g: per/day)')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                        {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                    </div>
                {!! Form::close() !!}
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

        });
    </script>
@endsection