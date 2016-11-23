@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/generate-coupon')}}">Coupon Generate</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Generate Coupon<small></small></h1>
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
                <h4 class="panel-title">Generate New Coupons</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/coupon/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate'=>true)) !!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('TitleLabel','Title :*', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('cTitle', null, array('id'=>'cTitle','class'=>'form-control', 'placeholder'=> 'Title'
                                ,'data-parsley-required'=>true,'data-parsley'=>'2122'
                                )) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('noCouponsLabel','No of Coupons :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-7">
                            {!! Form::text('noCoupons', null, array('id'=>'noCoupons','class'=>'form-control', 'placeholder'=> 'No of Coupons')) !!}
                        </div>

                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('expiryDateLabel','Expiry Date : *', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-7">
                            {!! Form::text('expiryDate', null, array('id'=>'datepicker-default','class'=>'form-control', 'placeholder'=> 'Select Date','readonly'=>'readonly'
                            ,'data-parsley-required'=>true,'data-parsley'=>'2120'
                            )) !!}
                        </div>
                        @if ($errors->has('expiryDate'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('expiryDate') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('DescriptionLabel','Description :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                                {!! Form::text('cDescription', null, array('id'=>'cDescription','class'=>'form-control', 'placeholder'=> 'Description')) !!}
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('StatusLabel','Status :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-3">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">New</option>
                                    <option value="2">Used</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('DiscountLabel','Discount :*', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-3">
                                {!! Form::text('discount', null, array('id'=>'discount','class'=>'form-control', 'placeholder'=> 'Discount'
                                ,'data-parsley-required'=>true,'data-parsley'=>'2121'
                                )) !!}
                            </div>
                            <div class="col-md-3">
                            <select class="form-control" name="discountType" id="discountType"  data-parsley-required="true"
                                    data-parsley = "2124">
                                <option value="1">%</option>
                                <option value="2">Amount</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('FileLabel','File :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-8">
                        {!! Form::file('cFile', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('generateTypeLabel','Generate Type :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-3">
                                <select class="form-control" name="generateType" id="generateType">
                                    <option value="1">Alpha</option>
                                    <option value="2">Numeric</option>
                                    <option value="3">Alpha Numeric</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    {!! Form::submit('Generate', array('class'=>'btn btn-success pull-right')) !!}
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
@section('bottom')
@section('page-scripts')
    <script type="text/javascript">
$('#status').val('1');
$('#datepicker-default').val(getDate());
    </script>
    <!-- All scripts Here -->
@endsection
@endsection