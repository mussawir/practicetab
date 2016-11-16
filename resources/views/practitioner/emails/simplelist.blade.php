@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Email Group Sent List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Group <small>List of group with sent email</small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Email Group Sent List</h4>
            </div>
            <div class="panel-body">
                <table id="dt_list" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Sent Date</th>
                        <th>Email Body</th>
                        <th>Sent To Group</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($list as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{date('m/d/Y H:i:s', strtotime($item->created_at))}}</td>
                            <td>
                                <div class="emailbody">
                                    {!! $item->message !!}
                                </div>
                            </td>
                            <td>{{$item->sent_to}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{url('/practitioner/emails/sent_list_details/'.$item->pe_id)}}'">View</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function() {
            if ($('#dt_list').length !== 0) {
                $('#dt_list').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 50,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [5]}]
                });
            }
//            var maxHeight=22;
//            var showText = "Show More";
//            var hideText = "Show Less";
//            $('.emailbody').each(function () {
//                var text = $(this);
//                if (($(this).text().length > 100) && (text.height() > maxHeight)) {
//                    text.css({ 'overflow': 'hidden','height': maxHeight + 'px' });
//
//                    var link = $('<a href="#" style="font-weight: bold;">' + showText + '</a>');
//                    var linkDiv = $('<div></div>');
//                    linkDiv.append(link);
//                    $(this).after(linkDiv);
//
//                    link.click(function (event) {
//                        event.preventDefault();
//                        if (text.height() > maxHeight) {
//                            $(this).html(showText);
//                            text.css('height', maxHeight + 'px');
//                        } else {
//                            $(this).html(hideText);
//                            text.css('height', 'auto');
//                        }
//                    });
//                }
//            });
        });

    </script>
@endsection