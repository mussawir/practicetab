@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small>Easy marketing tools</small></h1>
<!-- end page-header -->
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Today's Appointments &nbsp;&nbsp;
                            <span class="badge badge-danger">5</span> &nbsp;&nbsp;
                            Date:  {{date("Y-m-d H:i:s")}}
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Purpose</th>
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
                <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Supplements Suggestions
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Patients</th>
                                    <th>No. of Supplements</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suggestion as $item1)
                                <tr>

                                    <td>{{date('m/d/Y')}}</td>
                                    <td><span class="badge badge-danger">{{count(json_decode($item1->pa_ids))}}</span></td>
                                    <td><span class="badge badge-danger">{{count(json_decode($item1->sup_ids))}}</span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{url('/practitioner/suggestion/supplement-suggestions-details/'.$item1->id)}}'">View</button>
                                    </td>
                                </tr>
                                @endforeach
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
                <div class="panel panel-primary" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Today's Appointments &nbsp;&nbsp;
                            <span class="badge badge-danger">5</span> &nbsp;&nbsp;
                            Date:  {{date("Y-m-d H:i:s")}}
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Purpose</th>
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
                <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Nutrition Suggestions
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Patients</th>
                                    <th>No. of Nutritions</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($list_nut as $item)
                                    <tr>

                                        <td>{{date('m/d/Y')}}</td>
                                        <td><span class="badge badge-danger">{{count(json_decode($item->pa_ids))}}</span></td>
                                        <td><span class="badge badge-danger">{{count(json_decode($item->nut_ids))}}</span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{url('/practitioner/suggestion/nutrition-suggestions-details/'.$item->id)}}'">View</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div><!-- / end row -->
@endsection