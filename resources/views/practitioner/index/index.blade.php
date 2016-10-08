@extends('layouts.pradash')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Appointments
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-twitter fa-stack-1x"></i>
									</span>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed enim arcu.
                                        Ut posuere in ligula quis ultricies. In in justo turpis. Donec ut dui at massa gravida
                                        interdum nec vitae justo. Quisque ullamcorper vehicula dictum. Nullam hendrerit interdum eleifend.
                                        Aenean luctus sed arcu laoreet scelerisque. Vivamus non ullamcorper mauris, id sagittis lorem.
                                        Proin tincidunt mauris et dolor mattis imperdiet. Sed facilisis mattis diam elementum adipiscing.
                                    </p>
                                    <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-google-plus fa-stack-1x"></i>
									</span>
                                        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                                        Ut ante velit, pretium non nisi a, egestas placerat diam. Nullam aliquet iaculis ultricies.
                                        Aliquam volutpat, sapien quis volutpat elementum, ligula purus auctor diam, at vestibulum nulla augue
                                        vel purus. Praesent ac nisl a magna tincidunt interdum sed in turpis. Maecenas nec condimentum risus.
                                        In congue pretium est, eget euismod tortor ornare quis.
                                    </p>
                                    <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-facebook fa-stack-1x"></i>
									</span>
                                        Praesent eu ultrices justo. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Cras mattis ipsum quis sapien consectetur fringilla.
                                        Etiam sagittis sem tempus purus elementum, vitae pretium sapien porta. Curabitur iaculis ante ut aliquam luctus.
                                        Vivamus ullamcorper blandit imperdiet. Ut egestas, orci id rhoncus cursus, orci risus scelerisque enim, eget mattis eros lacus quis ligula.
                                        Vivamus ullamcorper urna eget hendrerit laoreet.
                                    </p>
                                    <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-apple fa-stack-1x"></i>
									</span>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                        Morbi accumsan velit dolor. Donec convallis eleifend magna, at euismod tellus convallis a.
                                        Curabitur in nisi dolor. Cras viverra scelerisque orci, sed interdum ligula volutpat non.
                                        Nunc eu enim ac neque tempor feugiat. Duis posuere lacus non magna eleifend,
                                        non dictum sem feugiat. Duis eleifend condimentum pulvinar.
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
            <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-inverse btn-xs" onclick="window.location.href='{{url('/practitioner/index/suggestions')}}'">New</button>
                    </div>
                    <h4 class="panel-title">
                        Suggestions
                    </h4>
                </div>
                <div class="panel-body">
                    <div data-scrollbar="true" data-height="300px">
                        <table id="sug-data-table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Group</th>
                                <th>Heading</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Vitamins - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Calcium - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Vitamin D - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Supplement Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sup-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Request Title</th>
                                        <th>Patient Name</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supplement_requests as $sr)
                                    <tr>
                                        <td>{{$sr->title}}</td>
                                        <td>{{$sr->first_name.' '. $sr->last_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-warning" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Nutrition Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-twitter fa-stack-1x"></i>
									</span>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed enim arcu.
                                    Ut posuere in ligula quis ultricies. In in justo turpis. Donec ut dui at massa gravida
                                    interdum nec vitae justo. Quisque ullamcorper vehicula dictum. Nullam hendrerit interdum eleifend.
                                    Aenean luctus sed arcu laoreet scelerisque. Vivamus non ullamcorper mauris, id sagittis lorem.
                                    Proin tincidunt mauris et dolor mattis imperdiet. Sed facilisis mattis diam elementum adipiscing.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-google-plus fa-stack-1x"></i>
									</span>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                                    Ut ante velit, pretium non nisi a, egestas placerat diam. Nullam aliquet iaculis ultricies.
                                    Aliquam volutpat, sapien quis volutpat elementum, ligula purus auctor diam, at vestibulum nulla augue
                                    vel purus. Praesent ac nisl a magna tincidunt interdum sed in turpis. Maecenas nec condimentum risus.
                                    In congue pretium est, eget euismod tortor ornare quis.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-facebook fa-stack-1x"></i>
									</span>
                                    Praesent eu ultrices justo. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Cras mattis ipsum quis sapien consectetur fringilla.
                                    Etiam sagittis sem tempus purus elementum, vitae pretium sapien porta. Curabitur iaculis ante ut aliquam luctus.
                                    Vivamus ullamcorper blandit imperdiet. Ut egestas, orci id rhoncus cursus, orci risus scelerisque enim, eget mattis eros lacus quis ligula.
                                    Vivamus ullamcorper urna eget hendrerit laoreet.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-apple fa-stack-1x"></i>
									</span>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Morbi accumsan velit dolor. Donec convallis eleifend magna, at euismod tellus convallis a.
                                    Curabitur in nisi dolor. Cras viverra scelerisque orci, sed interdum ligula volutpat non.
                                    Nunc eu enim ac neque tempor feugiat. Duis posuere lacus non magna eleifend,
                                    non dictum sem feugiat. Duis eleifend condimentum pulvinar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Exercise Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-twitter fa-stack-1x"></i>
									</span>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed enim arcu.
                                    Ut posuere in ligula quis ultricies. In in justo turpis. Donec ut dui at massa gravida
                                    interdum nec vitae justo. Quisque ullamcorper vehicula dictum. Nullam hendrerit interdum eleifend.
                                    Aenean luctus sed arcu laoreet scelerisque. Vivamus non ullamcorper mauris, id sagittis lorem.
                                    Proin tincidunt mauris et dolor mattis imperdiet. Sed facilisis mattis diam elementum adipiscing.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-google-plus fa-stack-1x"></i>
									</span>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                                    Ut ante velit, pretium non nisi a, egestas placerat diam. Nullam aliquet iaculis ultricies.
                                    Aliquam volutpat, sapien quis volutpat elementum, ligula purus auctor diam, at vestibulum nulla augue
                                    vel purus. Praesent ac nisl a magna tincidunt interdum sed in turpis. Maecenas nec condimentum risus.
                                    In congue pretium est, eget euismod tortor ornare quis.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-left m-r-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-facebook fa-stack-1x"></i>
									</span>
                                    Praesent eu ultrices justo. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Cras mattis ipsum quis sapien consectetur fringilla.
                                    Etiam sagittis sem tempus purus elementum, vitae pretium sapien porta. Curabitur iaculis ante ut aliquam luctus.
                                    Vivamus ullamcorper blandit imperdiet. Ut egestas, orci id rhoncus cursus, orci risus scelerisque enim, eget mattis eros lacus quis ligula.
                                    Vivamus ullamcorper urna eget hendrerit laoreet.
                                </p>
                                <p>
									<span class="fa-stack fa-4x pull-right m-l-10 text-inverse">
										<i class="fa fa-square-o fa-stack-2x"></i>
										<i class="fa fa-apple fa-stack-1x"></i>
									</span>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Morbi accumsan velit dolor. Donec convallis eleifend magna, at euismod tellus convallis a.
                                    Curabitur in nisi dolor. Cras viverra scelerisque orci, sed interdum ligula volutpat non.
                                    Nunc eu enim ac neque tempor feugiat. Duis posuere lacus non magna eleifend,
                                    non dictum sem feugiat. Duis eleifend condimentum pulvinar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#sug-data-table').length !== 0) {
                $('#sug-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            if ($('#sup-data-table').length !== 0) {
                $('#sup-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });
    </script>
@endsection