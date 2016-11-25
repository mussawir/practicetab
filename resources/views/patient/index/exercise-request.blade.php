@extends('layouts.padash')

@section('content')
    <section>
        <div class="msg">
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

        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="{{url('/patient')}}">Dashboard</a></li>
            <li class="active">Exercise Request</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Exercise Request <small></small></h1>
        <!-- end page-header -->

        {!! Form::open(array('url'=>'/patient/index/saveExerciseRequest','data-parsley-validate' => 'true')) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Practitioners
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <select name="pra_id" class="default-select2 form-control" data-parsley-required="true">
                                <option value="">Select Practitioner</option>
                                @foreach($practitioners as $item)
                                    <option value="{{$item->pra_id}}">{{$item->first_name .' '.$item->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Request Title', 'data-parsley-required'=>'true')) !!}
                            @if ($errors->has('title'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::textarea('message', null, array('class'=>'form-control', 'placeholder'=>'Request Message', 'rows'=>'5', 'data-parsley-required'=>'true')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Send', array('class'=>'btn btn-success pull-right')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Exercise
                        </h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exercise as $item)
                                <tr>
                                    <td>
                                        @if(isset($item->image1) && (!empty($item->image1)))
                                            <img src="{{asset('public/dashboard/img/exercise/'.$item->image1)}}" alt="{{$item->heading}}" class="img-responsive" style="max-height: 64px;" />
                                        @else
                                            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->heading}}" />
                                        @endif
                                    </td>
                                    <td>{{$item->heading}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="exe_id[]" value="{{$item->exe_id}}">
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
        </div>
        {!! Form::close() !!}
    </section>
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
    </script>
@endsection