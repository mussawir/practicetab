@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/patient')}}">Patients</a></li>
    <li class="active">Prescribe Supplement</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<div class="row">
    <div class="col-md-3">
        <h1 class="page-header">Add Supplement:</h1>
    </div>
    <div class="col-md-1">
        @if(isset($table1->main_image) && (!empty($table1->main_image)))
            <img src="{{asset('public/dashboard/img/sup-img/'.$table1->main_image)}}" alt="{{$table1->name}}" class="img-responsive" style="max-height: 64px;" />
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
                {!! Form::open(array('url'=>'/practitioner/supplement-prescription/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

                {!! Form::hidden('sup_id', $table1->sup_id) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('notes','Notes *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('notes', null, array('class'=>'form-control', 'placeholder'=> 'Notes', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                 </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('age','Age:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('age', null, array('class'=>'form-control', 'placeholder'=> 'Age')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('dosage','Dosage:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('dosage', null, array('class'=>'form-control', 'placeholder'=> 'Dosage')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('weight','Weight:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('weight', null, array('class'=>'form-control', 'placeholder'=> 'Weight (e.g: ml, kg, mg)')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('forms','Forms:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('forms', null, array('class'=>'form-control', 'placeholder'=> 'Forms (pill, injection, liquid, patch, etc)')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('use','Use:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('use', array(""=>"Select", "Regularly"=>"Regularly", "Occasionally"=>"Occasionally"), array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('start_date','Start Date:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('start_date', null, array('id'=>'start_date', 'class'=>'form-control', 'placeholder'=> 'Start Date', 'readonly')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('stop_date','Stop Date:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('stop_date', null, array('id'=>'stop_date', 'class'=>'form-control', 'placeholder'=> 'Stop Date', 'readonly')) !!}
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
            $('#start_date').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            $('#stop_date').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            var d = new Date();
            var day = d.getDate();
            var month = d.getMonth();
            var year = d.getFullYear();
            var currentDate = (month+1) + "/" + day + "/" + year;

            $('#start_date').val(currentDate);
            $('#stop_date').val(currentDate);

            // link between dates
            $('#start_date').on("changeDate", function (e) {
                var endDate = new Date(e.date.valueOf());
                $('#stop_date').datepicker('setStartDate', endDate);
            });
            $('#stop_date').on("changeDate", function (e) {
                var startDate = new Date(e.date.valueOf());
                $('#start_date').datepicker('setEndDate', startDate);
            });
        });
    </script>
@endsection