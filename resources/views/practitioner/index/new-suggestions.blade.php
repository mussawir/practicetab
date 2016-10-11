@extends('layouts.pradash')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
        <li class="active">Suggestions</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Suggestions <small></small></h1>
    <!-- end page-header -->

    <div class="row">
        <div class="col-md-12 msg">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong>{{Session::pull('success')}}</strong>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger">
                    <strong>{{Session::pull('error')}}</strong>
                </div>
            @endif
        </div>

        {!! Form::open(array('url'=>'/practitioner/index/saveSuggestions', 'id'=>'frm-suggestions')) !!}
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Select Supplements For Recommendation
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Used For</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supplements as $item)
                            <tr>
                                <td>
                                    @if(isset($item->main_image) && (!empty($item->main_image)))
                                        <img src="{{asset('public/dashboard/img/sup-img/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 64px;" />
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->used_for}}</td>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sup_id[]" value="{{$item->sup_id}}">
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Suggest To Group
                    </h4>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <select name="cg_id" class="default-select2 form-control">
                            <option value="">Select Patient Group</option>
                            @foreach($contact_groups as $item)
                                <option value="{{$item->cg_id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="Message" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Send', array('class'=>'btn btn-success pull-right')) !!}
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            $(".default-select2").select2();

            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }
        });

        $('#frm-suggestions').submit(function () {
            if ($('[name="sup_id[]"]:checked').length == 0) {
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
    </script>
@endsection