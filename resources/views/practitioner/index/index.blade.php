@extends('layouts.pradash')
@section('content')
@section('sidebar')
    @include('layouts.pradash-sidebar')
@endsection

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Today's Appointments &nbsp;&nbsp;
                                <?php
                                use Illuminate\Support\Facades\Auth;
                                use Illuminate\Support\Facades\DB;
                                $countScheduler = DB::table('scheduler')
                                        ->where('pDate','=',date("Y-m-d"))
                                        ->count();
                                ?>
                              <span class="badge badge-danger"><?php echo $countScheduler; ?></span> &nbsp;&nbsp;
                                Date:  {{date("Y-m-d")}}
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sug-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Time</th>
                                        <th>Duration (min)</th>
                                        <th>Patient</th>
                                        <th>Purpose</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $date = new DateTime('08:00:00'); ?>
                                    <?php
                                    $scheduler = DB::table('scheduler')
                                            ->where('pDate','=',date("Y-m-d"))
                                            ->get();
                                    $counter=0;
                                    $result='';
                                            $trOpen = "<tr>";
                                            $closeTr = "</tr>";
                                    foreach ($scheduler as $schedule)
                                    {
                                        $result = $trOpen;
                                        $result .= '<td>'. $schedule->id .'</td>';
                                        $result .= '<td>'. $schedule->pTime .'</td>';
                                        $result .= '<td>'. $schedule->pDuration .'</td>';
                                        $result .= '<td>'. $schedule->patient_id .'</td>';
                                        $result .= '<td>'. $schedule->reason .'</td>';
                                        $result.= $closeTr;
                                    }
                                    echo $result;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
            <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Suggestions
                    </h3>
                </div>
                <div class="panel-body">
                    <div data-scrollbar="true" data-height="300px">
                        <table id="sug-data-table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Group</th>
                                <th>Heading</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Vitamins - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Calcium - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>{{date('m/d/Y')}}</td>
                                <td>Vitamin D - Patient</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Supplement Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sup-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Request Title</th>
                                        <th>Patient Name</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supplement_requests as $sr)
                                    <tr>
                                        <td>{{$sr->title}}</td>
                                        <td>{{$sr->first_name.' '. $sr->last_name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success">View</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-warning" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Nutrition Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sug-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Patient</th>
                                        <th>Request Contents</th>
                                        <th>Nut#</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $date = new DateTime('08:00:00'); ?>
                                    @for ($i = 1; $i < 21; $i++)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <?php
                                                $date->add(new DateInterval('PT30M'));
                                               echo date("d/m/Y");
                                                    echo "<br/>";
                                               echo $date->format('h:i:s') . "\n";  //it i will give you 10:00:00
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                //PHP array containing forenames.
                                                $names = array(
                                                        'Christopher',
                                                        'Ryan',
                                                        'Ethan',
                                                        'John',
                                                        'Zoey',
                                                        'Sarah',
                                                        'Michelle',
                                                        'Samantha',
                                                        'Noah		',
                                                        'Liam		',
                                                        'Ethan		',
                                                        'Mason		',
                                                        'Lucas		',
                                                        'Oliver		',
                                                        'Aiden		',
                                                        'Elijah		',
                                                        'James		',
                                                        'Benjamin	',
                                                        'Logan		',
                                                        'Jacob		',
                                                        'Jackson	',
                                                        'Michael	',
                                                        'Carter		',
                                                        'Daniel		',
                                                        'Alexander	',
                                                        'William	',
                                                        'Luke		',
                                                        'Owen		',
                                                        'Jack		',
                                                        'Gabriel	',
                                                        'Matthew	',
                                                        'Henry		',
                                                );

                                                //PHP array containing surnames.
                                                $surnames = array(
                                                        'Walker',
                                                        'Thompson',
                                                        'Anderson',
                                                        'Johnson',
                                                        'Tremblay',
                                                        'Peltier',
                                                        'Cunningham',
                                                        'Simpson',
                                                        'Mercado',
                                                        'Sellers'
                                                );

                                                //Generate a random forename.
                                                $random_name = $names[mt_rand(0, sizeof($names) - 1)];

                                                //Generate a random surname.
                                                $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];

                                                //Combine them together and print out the result.
                                                echo $random_name . ' ' . $random_surname;
                                                ?>

                                            </td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td>
                                            <td><span class="badge badge-danger">{{rand ( 1 , 10)}}</span></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info">View</button>
                                            </td>
                                        </tr>
                                    @endfor

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-success" data-sortable-id="ui-widget-7" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Exercise Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="exercise-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Exercise/s</th>
                                        <th>Patient</th>
                                        <th>Request Contents</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $date = new DateTime('08:00:00'); ?>
                                    @for ($i = 1; $i < 9; $i++)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <?php
                                                $date->add(new DateInterval('PT30M'));
                                                echo date("d/m/Y");
                                                echo "<br/>";
                                                echo $date->format('h:i:s') . "\n";  //it i will give you 10:00:00
                                                ?>

                                            </td>
                                            <td>
                                                                                                <!-- img src="{{asset('public/img/exercise/'.$i.'.jpg')}}" alt="" class="img-responsive"/ -->
                                                <span class="badge badge-danger">{{rand ( 1 , 10)}}</span>

                                            </td>
                                            <td>
                                                <?php
                                                //PHP array containing forenames.
                                                $names = array(
                                                        'Christopher',
                                                        'Ryan',
                                                        'Ethan',
                                                        'John',
                                                        'Zoey',
                                                        'Sarah',
                                                        'Michelle',
                                                        'Samantha',
                                                        'Noah		',
                                                        'Liam		',
                                                        'Ethan		',
                                                        'Mason		',
                                                        'Lucas		',
                                                        'Oliver		',
                                                        'Aiden		',
                                                        'Elijah		',
                                                        'James		',
                                                        'Benjamin	',
                                                        'Logan		',
                                                        'Jacob		',
                                                        'Jackson	',
                                                        'Michael	',
                                                        'Carter		',
                                                        'Daniel		',
                                                        'Alexander	',
                                                        'William	',
                                                        'Luke		',
                                                        'Owen		',
                                                        'Jack		',
                                                        'Gabriel	',
                                                        'Matthew	',
                                                        'Henry		',
                                                );

                                                //PHP array containing surnames.
                                                $surnames = array(
                                                        'Walker',
                                                        'Thompson',
                                                        'Anderson',
                                                        'Johnson',
                                                        'Tremblay',
                                                        'Peltier',
                                                        'Cunningham',
                                                        'Simpson',
                                                        'Mercado',
                                                        'Sellers'
                                                );

                                                //Generate a random forename.
                                                $random_name = $names[mt_rand(0, sizeof($names) - 1)];

                                                //Generate a random surname.
                                                $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];

                                                //Combine them together and print out the result.
                                                echo $random_name . ' ' . $random_surname;
                                                ?>

                                            </td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-info">View</button>
                                            </td>
                                        </tr>
                                    @endfor

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#sug-data-table').length !== 0) {
                $('#sug-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            if ($('#sup-data-table').length !== 0) {
                $('#sup-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }


            if ($('#exercise-data-table').length !== 0) {
                $('#exercise-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });
    </script>
@endsection