@extends('layouts.management')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/manufacturer')}}">Add Exercise</a></li>
    <li class="active">Add</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<div class="row">
    <div class="col-md-4">  <h1 class="page-header">Add Exercise: {{$table1->heading}}</h1></div>
    <div class="col-md-1">
        @if(isset($table1->image1) && (!empty($table1->image1)))
            <img src="{{asset('public/img/exercise/'.$table1->image1)}}" alt="{{$table1->image1}}" class="img-responsive" style="max-height: 64px;" />
        @else
            <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$table1->image1}}" />
        @endif
    </div>
    <div class="col-md-1">
        @if(isset($table1->image2) && (!empty($table1->image2)))
            <img src="{{asset('public/img/exercise/'.$table1->image2)}}" alt="{{$table1->image2}}" class="img-responsive" style="max-height: 64px;" />
        @else
            <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$table1->image2}}" />
        @endif
    </div>
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
                {!! Form::open(array('url'=>'/practitioner/exercise-prescription/store-exercise', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                {!! Form::hidden('exe_id', $table1->exe_id) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('notes','Notes *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('notes', null, array('class'=>'form-control', 'placeholder'=> 'Notes', 'required'=> 'required')) !!}
                        </div>
                    </div>
                 </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('sets','Sets:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('sets', null, array('class'=>'form-control', 'placeholder'=> 'Sets')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('reps','Reps:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('reps', null, array('class'=>'form-control', 'placeholder'=> 'Repetitions')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('weight','Weight:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('weight', null, array('class'=>'form-control', 'placeholder'=> 'Weight')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('hold','Hold:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('hold', null, array('class'=>'form-control', 'placeholder'=> 'Hold')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('rest','Rest:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('rest', null, array('class'=>'form-control', 'placeholder'=> 'Rest')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('duration','Duration:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('duration', null, array('class'=>'form-control', 'placeholder'=> 'Duration')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('hold','Hold:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('hold', null, array('class'=>'form-control', 'placeholder'=> 'Hold')) !!}
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
    <script language="JavaScript/text">

    </script>
@endsection
