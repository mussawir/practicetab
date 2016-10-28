<div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
           <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Recommended Nutrition List</h4>
        </div>
    <div class="panel-body">
        <div data-scrollbar="true" data-height="300px">
            <table id="exercise-data-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>Benefits</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($nut_sug_master as $item)
                    <tr>
                        <td>{{date('m/d/Y H:i:s', strtotime($item->created_at))}}</td>
                        <td>{{$item->pra_fullname}}</td>
                        <td>{{$item->message}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{url('/patient/index/nutrition-suggestion-details/'.$item->id)}}'">View</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>