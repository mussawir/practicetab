@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/patient')}}">Dashboard</a></li>
    <li class="active">Recommended Supplement Details</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Recommended Supplement Details<small></small></h1>
<!-- end page-header -->

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <h3>Practitioner: {{$sup_sug_master->pra_fullname}}</h3>
                <h4>Message: {{$sup_sug_master->message}}</h4>
            </div>

            <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Details</h4>
                </div>
                <div class="panel-body">
                    <table id="dt-sup-sug" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter=1;?>
                            @foreach($supplements as $item)
                                <tr>
                                    <td>{{$counter++}}</td>
                                    <td>
                                        @if(isset($item->main_image) && (!empty($item->main_image)))
                                            <img src="{{asset('public/dashboard/img/sup-img/'.$item->main_image)}}" alt="{{$item->name}}" class="img-responsive" style="max-height: 64px;" />
                                        @else
                                            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->name}}" />
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <button onclick="showDescription('{{$item->long_description}}')" type="button" class="btn btn-sm btn-info">View</button>
                                    </td>
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
                    <hr/>
                    <button type="button" class="btn btn-success pull-right">Order</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#dt-sup-sug').length !== 0) {
                $('#dt-sup-sug').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }
        });
        function showDescription(desc)
        {
            if(desc=="")
            {
                return;
            }
            showDialouge('content','Description',desc);
        }
    </script>
@endsection