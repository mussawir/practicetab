@extends('layouts.pradash')
@section('sidebar')
    @include('layouts.pra-sidebar')
@endsection
@section('content')
    <div class="row">
            <div class="col-md-12">
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
                <h1 class="text-primary">Patient List</h1>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                    <tr>
                        <th class="text-primary">Name</th>
                        <th class="text-primary">Email</th>
                        <th class="text-primary">Phone</th>
                        <th class="text-primary">Cell</th>
                        <th class="text-primary">Gender</th>
                        <th class="text-primary">Address</th>
                        <th class="text-primary">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($patients as $item)
                        <tr>
                            <td>{{ucwords($item->first_name) .' '. ucwords($item->last_name)}}</td>
                            <td class="text-center">{{$item->email}}</td>
                            <td class="text-center">{{$item->phone}}</td>
                            <td class="text-center">{{$item->cell}}</td>
                            <td class="text-center">{{$item->gender==0?'Male':'Female'}}</td>
                            <td class="text-center">{{$item->address}}</td>
                            <td class="text-center">
                                <a href="#"><i class="fa fa-pencil"></i> Edit</a> |
                                <a href="#"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function(){
            if($('.msg').length>0){
                $('.msg').delay(5000).fadeOut('slow');
            }

            $('#dataTables').dataTable(
                    {
                        responsive: true,
                        "aaSorting": [[0, "asc"]],
                        "iDisplayLength": 50,
                        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        "aoColumnDefs": [{'bSortable': false, 'aTargets': [6]}]
                    }
            );
        }); // ready function end
    </script>
@endsection