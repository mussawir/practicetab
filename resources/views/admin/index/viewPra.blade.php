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
            <div class="panel-body"
                 style="
    font-size: 16px;
"
            >
                <h3>Personal Details </h3>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                @if(isset($item->photo) && (!empty($item->photo)))
                                    <img src="{{asset('public/practitioners/'. $item->directory .'/'.$item->photo)}}" alt="Practitioner Photo" class="img-responsive" style="max-height: 80px;" />
                                @else
                                    <img src="{{asset('public/img/no-user.jpg')}}" alt="Practitioner Photo" style="max-height: 80px;"/>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                &nbsp;
                                </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <b>Name :</b>
                                    {{$item->first_name}} {{$item->last_name}}
                                </div>
                                <div class="col-md-12">
                                    <b> Email :</b>
                                    {{$item->email}}
                                </div>
                                <div class="col-md-12">
                                    <b> Phone :</b>
                                    @if (isset($item->primary_phone) && (!empty($item->primay_phone)))
                                        {{$item->primary_phone}}
                                    @else
                                        {{$item->secondary_phone}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                <h3>Clinic Info </h3>
                <div class="row">
                    <div class="col-md-12">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2">
                            @if(isset($item->clinic_logo) && (!empty($item->clinic_logo)))
                                <img src="{{asset('public/practitioners/'. $item->directory .'/'.$item->clinic_logo)}}" alt="Clinic Photo" class="img-responsive" style="max-height: 80px;" />
                            @else
                                <img src="{{asset('public/img/no-user.jpg')}}" alt="Clinic Photo" style="max-height: 80px;"/>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <b> City :</b>
                            {{$item->clinic_city}}
                        </div>
                        <div class="col-md-12">
                            <b> State :</b>
                            {{$item->clinic_state}}
                        </div>
                        <div class="col-md-12">
                            <b>Address :</b>
                            {{$item->clinic_street_address}}
                        </div>
                        <div class="col-md-12">
                            <b> Phone :</b>{{$item->clinic_phone}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        &nbsp;
                    </div>
                </div>


                <!-- Plan Type -->
                <h3>Plan Type Info </h3>
                <div class="row">
                    <div class="col-md-12">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <b> Plan Type :</b>
                            {{$item->plan_type}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        &nbsp;
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