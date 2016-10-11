@extends('layouts.padash')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Advertisement for any Supplement or Nutrition</h2>
    </div>
</div>
<!-- begin row -->
<div class="row">
    <h3>Recommended for you</h3>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
                    <li class="active"><a href="#supplements" data-toggle="tab"><i class="fa fa-picture-o m-r-5"></i> <span class="hidden-xs">Supplements</span></a></li>
                    <li class=""><a href="#nutrition" data-toggle="tab"><i class="fa fa-shopping-cart m-r-5"></i> <span class="hidden-xs">Nutrition</span></a></li>
                    <li class=""><a href="#exercises" data-toggle="tab"><i class="fa fa-envelope m-r-5"></i> <span class="hidden-xs">Exercises</span></a></li>
                </ul>
                <div class="tab-content" data-sortable-id="index-3">
                    <div class="tab-pane fade active in" id="supplements">
                        <div class="height-sm" data-scrollbar="true">
                            <table id="sup-data-table" class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>Practitioner One</td>
                                    <td>Supplements <span class="badge badge-success">5</span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='{{url('/patient/index/suggestion-details')}}'">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Practitioner Two</td>
                                    <td>Supplements <span class="badge badge-success">2</span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='{{url('/patient/index/suggestion-details')}}'">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Practitioner Three</td>
                                    <td>Supplements <span class="badge badge-success">1</span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='{{url('/patient/index/suggestion-details')}}'">View Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Practitioner Four</td>
                                    <td>Supplements <span class="badge badge-success">6</span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='{{url('/patient/index/suggestion-details')}}'">View Details</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nutrition">
                        <div class="height-sm" data-scrollbar="true">

                        </div>
                    </div>
                    <div class="tab-pane fade" id="exercises">
                        <div class="height-sm" data-scrollbar="true">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Advertisements</h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="200px">

                        </div>
                    </div>
                </div>
                <!-- panel end -->
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Appointments</h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="200px">

                        </div>
                    </div>
                </div>
                <!-- panel end -->
            </div>
        </div>
        <!-- row end -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Article</h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="200px">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- panel end -->
            </div>
        </div>
        <!-- row end -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Ads</h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="200px">

                        </div>
                    </div>
                </div>
                <!-- panel end -->
            </div>
        </div>
        <!-- row end -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Article</h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="200px">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Aenean mollis arcu sed turpis accumsan dignissim. Etiam vel tortor at risus tristique convallis. Donec adipiscing euismod arcu id euismod. Suspendisse potenti. Aliquam lacinia sapien ac urna placerat, eu interdum mauris viverra.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- panel end -->
            </div>
        </div>
        <!-- row end -->
    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endsection