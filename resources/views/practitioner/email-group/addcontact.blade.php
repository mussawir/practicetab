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
        display:block;
        color:white;
        background:#34495e;
        padding:5px 0;
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
        <div class="col-md-8">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Add Patients To {{ $data['name'] }}</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=>'/practitioner/email-group/patients', 'class'=> 'form-horizontal')) !!}

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
                            @foreach($patients as $item)
                                <tr>
                                    <td>
                                        <a href="javascript:void(0);" onclick="doAdd({{$item->user_id}})" id="addbutton" class="btn btn-success btn-xs">Add</a>
                                    </td>
                                    <td>{{$item->first_name. ' ' . $item->last_name}}</td>
                                    <td>{{$item->email}}</td>
                                    {{ Form::hidden('first_name', $item->first_name, array('id' => 'first_name')) }}
                                    {{ Form::hidden('last_name', $item->last_name, array('id' => 'last_name')) }}
                                    {{ Form::hidden('primary_phone', $item->primary_phone, array('id' => 'primary_phone')) }}
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
        <div class="col-md-4">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Add Patients To {{ $data['name'] }}</h4>
                </div>
                <div class="panel-body">
                    <table id="selected-table data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody id="selectedpatients">

                        </tbody>
                    </table>
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
        function doAdd(id)
        {

            $.ajax({
                type: "GET",
                url: '{{ URL::to('/practitioner/email-group/find') }}/' + id,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    /*if (result.status == 'success') {
                     $(elm).closest('tr').fadeOut();
                     $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                     } else {
                     $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                     }*/
//                        location.reload(true);
                    $("#selectedpatients").append("<tr><td>" + result.data.first_name + " " + result.data.last_name + "</td>" + "<td>" + "<a class='btn btn-danger btn-xs' onclick='deleteinfo(result.data.user_id)'>Remove</a>" + "</td></tr>");
                }
            });
            return false;

        }
        function deleteinfo(id)
        {
            $.ajax({
                type: "GET",
                url: '{{ URL::to('/practitioner/email-group/deleteinfo') }}/' + id,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    /*if (result.status == 'success') {
                     $(elm).closest('tr').fadeOut();
                     $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                     } else {
                     $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                     }*/
//                        location.reload(true);
//                    $("#selectedpatients").append("<tr><td>" + result.data.first_name + " " + result.data.last_name + "</td>" + "<td>" + "<a class='btn btn-danger btn-xs' onclick='removeRow(elm, result.data.user_id)'>Remove</a>" + "</td></tr>");
                alert(result.id);
                }
            });

        }

    </script>
@endsection