@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/profile')}}">Update Profile</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update Profile Details </h1>
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
                {!! Form::model($table1, array('url'=>'/practitioner/profile/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                {!! Form::hidden('pa_id') !!}
                {!! Form::hidden('photo') !!}

                <div><h4>Public Profile Information</h4>
                    <hr/>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('photo','Change Photo :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::file('photo', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{asset('public/practitioners/'. $directory .'/'.$table1->photo)}}" alt="{{$table1->photo}}" class="img-responsive" style="max-height: 64px;" />

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('suffix','Suffix :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('suffix', null, array('class'=>'form-control', 'placeholder'=> 'MD, DC, LAc, ND')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('first_name','First Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First Name', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('middle_name','Middle Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('middle_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('last_name','Last Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('primary_phone','Primary Phone *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('primary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Primary Phone', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('secondary_phone','Secondary Phone:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('secondary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Secondary Phone')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date_of_birth','Birth Date :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('date_of_birth', null, array('class'=>'form-control', 'placeholder'=> 'Birth date')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('url','URL :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('url', null, array('class'=>'form-control', 'placeholder'=> 'Birth date', 'readonly'=>'readonly')) !!}
                            <p>
                                <a href="{{url('/practitioner/'.$table1->url)}}" target="_blank">Public Profile Url</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4>Mailing Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_street_address','Street Address :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_zip','ZIP :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_city','City :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_state','State :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('mailing_state',array(
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
),$table1->mailing_state, array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Billing Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_street_address','Street Address :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_zip','ZIP :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_city','City :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_state','State :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('billing_state',array(
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
             ),$table1->billing_state, array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Credit Card Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cc_type','Card Type:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('cc_type',array(
""=>"Select",
"visa"=>"Visa",
"mastercard"=>"Mastercard",
"discovery"=>"Discovery",
"maestro"=>"Maestro",
),$table1->cc_type , array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cc_number','Card Number :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('cc_number', null, array('class'=>'form-control', 'placeholder'=> 'Card Number')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cc_month','Expiry Month :', array('class'=>'col-md-6 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('cc_month',array(
      "" =>"Month",
"01"=>"01",
"02"=>"02",
"03"=>"03",
"04"=>"04",
"05"=>"05",
"06"=>"06",
"07"=>"07",
"08"=>"08",
"09"=>"09",
"10"=>"10",
"11"=>"11",
"12"=>"12"
      ),$table1->cc_month ,array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cc_year','Expiry Year :', array('class'=>'col-md-6 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('cc_year',array(
    "" =>"Year",
"2016"=>"2016",
"2017"=>"2017",
"2018"=>"2018",
"2019"=>"2019",
"2020"=>"2020",
"2021"=>"2021",
"2022"=>"2022",
"2023"=>"2023",
"2024"=>"2024",
"2025"=>"2025",
"2026"=>"2026",
"2027"=>"2027",
"2028"=>"2028",
"2029"=>"2029",
"2030"=>"2030",
"2031"=>"2031",
"2032"=>"2032",
"2033"=>"2033",
"2034"=>"2034",
"2035"=>"2035",
"2036"=>"2036",
"2037"=>"2037",
"2038"=>"2038",
"2039"=>"2039"
      ),$table1->cc_year , array('class'=>'form-control', 'placeholder'=> 'State Name')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cc_cvv','CVV :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('cc_cvv', null, array('class'=>'form-control', 'placeholder'=> 'CVV Number')) !!}
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

@section('page-scripts')
    <script language="JavaScript/text">

    </script>
@endsection
