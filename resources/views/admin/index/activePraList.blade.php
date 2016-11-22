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
                <h4 class="panel-title">Practitioners List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Primary Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>
                                @if(isset($item->photo) && (!empty($item->photo)))
                                    <img src="{{asset('public/practitioners/'. $item->directory .'/'.$item->photo)}}" alt="Practitioner Photo" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/img/no-user.jpg')}}" alt="Practitioner Photo" style="max-height: 64px;"/>
                                @endif
                            </td>
                            <td>{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->primary_phone}}</td>
                            <td>
                                <a href="#"><i class="fa fa-pencil"></i> Edit</a> |
                                <!--<a href="javascript:void(0);"><i class="fa fa-trash-o"></i> Delete</a> -->
                                <?php if($item->inactive == 0) { ?>
                                <a id="block_{{$item->pra_id}}"  onclick="doDelete('{{$item->pra_id}}', 'block');" href="javascript:void(0);" ><i class="fa fa-lock"></i> Block</a>
                            <?php } else { ?>
                                <a id="unblock_{{$item->pra_id}}"  onclick="doDelete('{{$item->pra_id}}', 'unblock');" href="javascript:void(0);" ><i class="fa fa-unlock"></i> unBlock</a>
                                <?php } ?>
                                |<a href="{{url('admin/index/practitioner')}}/{{$item->pra_id}}"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 50,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [6]}]
                });
            }
        });

        function doDelete(id, elm)
        {
            //var q = confirm("Are you sure you want to delete this manufacturer?");
            //if (q == true)
            blockOrUnblock = 1;
            if(elm=='block')
            {
                blockOrUnblock = 1;
            }
            else if (elm == 'unblock')
            {
                blockOrUnblock = 0;
            }
            {

                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/admin/index/blockUnblockPra') }}',
                    data : {
                        blockOrUnblock : blockOrUnblock
                        ,pra_id : id
                    },
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
            }
            return false;
        }
    </script>
@endsection