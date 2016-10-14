<div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
           <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Recommended Supplements</h4>
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
                <?php $date = new DateTime('08:00:00'); ?>
                @for ($i = 1; $i < 9; $i++)
                    <tr>
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