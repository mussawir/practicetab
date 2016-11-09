@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/patient')}}">Patient</a></li>
    <li class="active">Files</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Manage {{$table1->first_name . " ". $table1->last_name."`s"}} Files </h1>
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
                <h4 class="panel-title">Files Management</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($table1, array('url'=>'/practitioner/patient/upload-files', 'method' => 'POST', 'class'=> 'form-horizontal', 'files'=>true)) !!}
                {!! Form::hidden('pa_id') !!}

                <div><h4>Add Files</h4>
                    <hr/>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('files[]','Upload Files :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::file('files[]', array('class'=>'form-control', 'accept'=>'*', 'multiple' )) !!}
                            </div>
                        </div>
                    </div>
                </div>

     <div class="col-md-1">
                    {!! Form::submit('Upload', array('class'=>'btn btn-success pull-right')) !!}
                </div>
                {!! Form::close() !!}

                <div class="col-md-12">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($table2 as $item)
       <tr>

           <td>
        {{$item->file_name}}
           </td>

           <td>
               <a href="javascript:void(0);" onclick="downloadFile('{{$item->pf_id}}', this);"><i class="fa fa-download"></i> Download</a> |
               <a href="javascript:void(0);" onclick="doDelete('{{$item->pf_id}}', this);"><i class="fa fa-trash-o"></i> Remove</a>

           </td>

       </tr>
@endforeach
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

/**
 *
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

 * <<<<<<< HEAD
 <a href="#"><i class="fa fa-trash-o"></i> Download</a> |

 <a href="javascript:void(0);" onclick="doDelete('{{$table1->pa_id, $item->pf_id}}', this);"><i class="fa fa-trash-o"></i> Remove</a>
 =======
 function doDelete(pa_id,pf_id, elm)
 {
     var q = confirm("Are you sure you want to remove this file?");
     if (q == true) {

         $.ajax({
             type: "DELETE",
             url: '{{ URL::to('/practitioner/patient/destroy-file') }}/' + pa_id + '/'+ pf_id,
             beforeSend: function (request) {
                 return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
             },
             success: function (result) {
                 if (result.status == 'success') {
                  $(elm).closest('tr').fadeOut();
                  $('.msg').html('<div class="alert alert-success"><strong>File is deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                  } else {
                  $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                  }
                 location.reload(true);
             },
             error:function (error) {
                 $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
             }
         });
         return false;
     }
     return false;
 }
 *//

    function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this file?");
            if (q == true) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ url('/practitioner/patient/destroy-file') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        if (result.status == 'success') {
                            $(elm).closest('tr').fadeOut();
                            $('.msg').html('<div class="alert alert-success"><strong>File deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                        } else {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }
                        //window.location.reload();
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
</script>
@endsection