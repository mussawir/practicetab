@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/profile')}}">Update Profile</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update Clinic Info</h1>
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
                <h4 class="panel-title">Update Details</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($table1, array('url'=>'/practitioner/profile/clinic-update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                {!! Form::hidden('pa_id') !!}
                {!! Form::hidden('photo') !!}

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('clinic_logo','Change Logo :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::file('clinic_logo', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{asset('public/practitioners/'. $directory .'/'.$table1->clinic_logo)}}" alt="{{$table1->clinic_logo}}" class="img-responsive" style="max-height: 64px;" />
                        <input type="hidden" name="saved_clinic_logo" value="{{$table1->clinic_logo}}"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_name','Clinic Name :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_name', null, array('class'=>'form-control', 'placeholder'=> 'Clinic Name' )) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 10px;">
                    <div class="form-group">
                        {!! Form::label('clinic_doc_head','Document Header:', array('class'=>'col-md-2')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('clinic_doc_head', null, array('id'=>'clinic_doc_head', 'class'=>'form-control', 'placeholder'=> 'Document Header', 'rows'=>'3')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('clinic_doc_footer','Document Footer:', array('class'=>'col-md-2')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('clinic_doc_footer', null, array('id'=>'clinic_doc_footer', 'class'=>'form-control', 'placeholder'=> 'Document Footer', 'rows'=>'3')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4>Contact/Address</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_phone','Clinic Phone# :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_phone', null, array('class'=>'form-control', 'placeholder'=> 'Clinic Phone Number')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_fax','Clinic FAX# :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_fax', null, array('class'=>'form-control', 'placeholder'=> 'Clinic FAX Number')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_email','Clinic Email :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_email', null, array('class'=>'form-control', 'placeholder'=> 'Clinic Phone Number')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_street_address','Street Address :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_zip','ZIP :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_city','City :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('clinic_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('clinic_state','State :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('clinic_state',array(
""=>"Select",
"AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho ",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming"
),$table1->clinic_state,array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right')) !!}
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
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            FormWysihtml5.init();

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('clinic_doc_head',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2),
                        height: 150
                    });

            CKEDITOR.replace('clinic_doc_footer',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2),
                        height: 150
                    });
        });
    </script>
@endsection
