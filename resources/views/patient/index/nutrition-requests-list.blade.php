@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/patient')}}">Dashboard</a></li>
    <li class="active">Nutrition Request List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Nutrition Request List<small></small></h1>
<!-- end page-header -->

<div class="row">

        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Requested Nutrition</h4>
            </div>
            <div class="panel-body">
                <table id="dt-sup-sug" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>No of Nutritions</th>
                        <th>Requested To</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    @foreach($request as $item)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{$item->message}}</td>
                            <td>
                                <?php
                                    $nut = \App\Models\NutritionRequestDetail::where('nr_id',$item->nr_id)->get();
                                ?>
                                   <span class='badge badge-danger'>{{ count($nut) }}</span>
                            </td>
                            <td>
                                <?php
                                    $name = \App\Models\Practitioner::select('first_name','last_name')->where('pra_id',$item->pra_id)->get()->first();
                                    echo $name['first_name']. ' '. $name['last_name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                if($item->status == 0){
                                    echo ' <i class="fa fa-circle" aria-hidden="true" style="color:orange"> Pending</i> ';
                                }elseif($item->status == 1){
                                    echo ' <i class="fa fa-check-circle" aria-hidden="true" style="color:green"> Approved</i> ';
                                }elseif($item->status == 2){
                                    echo ' <i class="fa fa-close" aria-hidden="true" style="color:red"> Rejected</i> ';
                                }
                                ?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr/>
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