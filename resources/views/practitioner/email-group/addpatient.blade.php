@extends('layouts.pradash')

@section('sidebar')
    @include('layouts.mark-sidebar')
    <style type="text/css">

        #ck-button:hover {
            background:#34495e;
        }

        #ck-button label {
            float:left;
            width:4.0em;
        }

        #ck-button label span {
            text-align:center;
            padding:5px 0px;
            display:block;
            color:white;
            background:#34495e;
        }

        #ck-button label input {
            position:absolute;
            top:-20px;
            display:none;
        }

        #ck-button input:checked + span {
            background-color:#2ecc71;
            color:#fff;
            display:block;
            width:4.0em;
        }
    </style>
    @endsection

    @section('content')
            <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/practitioner/marketing')}}">Marketing Dashboard</a></li>
        <li><a href="{{url('/practitioner/contact-group')}}">Email Groups</a></li>
        <li class="active">New</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Email Groups <small>New Email Group</small></h1>
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
            <div class="col-md-12">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Add Contacts To {{ $data['name'] }}</h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url'=>'/practitioner/email-group/confirmed', 'class'=> 'form-horizontal')) !!}

                        {{ Form::hidden('name', $data['name'], array('id' => 'invisible_id')) }}
                        {{ Form::hidden('description', $data['desc'], array('id' => 'invisible_id')) }}
                        <div class="col-md-12">
                            <table id="data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th><i class="glyphicon glyphicon-unchecked"></i></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contact as $item)
                                    <tr>
                                        <td>
                                            <div id="ck-button">
                                                <label>
                                                    <input type="checkbox" name="email[]" value="{{$item->email}}"><span>Add</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$item->first_name. ' ' . $item->last_name}}</td>
                                        <td>{{$item->email}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! Form::submit('Next', array('class'=>'btn btn-success pull-right')) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>


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
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });




    </script>
@endsection