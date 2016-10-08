@extends('layouts.padash')

@section('content')
    <section>
        <form action="#">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Practitioners
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <select class="default-select2 form-control">
                                <option value="">-- Select --</option>
                            @foreach($practitioners as $item)
                                    <option value="{{$item->pra_id}}">{{$item->first_name .' '.$item->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                            <textarea class="form-control" placeholder="Message" rows="5"></textarea>
                            </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Supplements
                    </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Used For</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supplements as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->used_for}}</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{$item->sup_id}}">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </form>
    </section>
@endsection

@section('page-scripts')
<script type="text/javascript">
    $(function () {
        $(".default-select2").select2();

        if ($('#data-table').length !== 0) {
            $('#data-table').DataTable({
                responsive: true
            });
        }
    });
</script>
@endsection