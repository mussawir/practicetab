@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Email Templates</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Templates <small></small></h1>
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
                <h4 class="panel-title">Email Template List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th style="min-width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$counter++}} </td>
                            <td>{{$item->name}} </td>
                            <td>
                                <div class="content-container">{!! $item->template!!}</div>
                            </td>
                            <td>
                                <a href="{{url('/admin/email-templates/view/'.$item->et_id)}}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                 |
                                <a href="{{url('/admin/email-templates/edit/'.$item->et_id)}}"><i class="fa fa-pencil"></i> Edit</a>
                                <!-- <a href="javascript:void(0);" onclick="doDelete('{{$item->et_id}}', this);"><i class="fa fa-trash-o"></i> Delete</a> -->
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            var maxHeight=22;
            var showText = "Show More";
            var hideText = "Show Less";
            $('.content-container').each(function () {
                var text = $(this);
                if (($(this).text().length > 100) && (text.height() > maxHeight)) {
                    text.css({ 'overflow': 'hidden','height': maxHeight + 'px' });

                    var link = $('<a href="#" style="font-weight: bold;">' + showText + '</a>');
                    var linkDiv = $('<div></div>');
                    linkDiv.append(link);
                    $(this).after(linkDiv);

                    link.click(function (event) {
                        event.preventDefault();
                        if (text.height() > maxHeight) {
                            $(this).html(showText);
                            text.css('height', maxHeight + 'px');
                        } else {
                            $(this).html(hideText);
                            text.css('height', 'auto');
                        }
                    });
                }
            });
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this email template?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ url('/admin/email-templates/destroy') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                            $(elm).closest('tr').fadeOut();
                            $('.msg').html('<div class="alert alert-success"><strong>Template deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                        } else {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }*/
                        window.location.reload();
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