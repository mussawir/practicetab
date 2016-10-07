@extends('layouts.front')

@section('content')
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
    <section class="login-wrap">
        <div class="pra-reg">
            <h1>Join Practicetabs</h1>
            <h2>Your all-in-one, cloud-based, practice solution.</h2>

            <form method="post" class="add-patient register">
                <div class="first-section box">
                    <h2>Almost Done!</h2>
                    <p>You chose the Premium Plan.</p>
                    <p>Enter your billing information below to get started with PracticeTabs!</p>
                    <ul>
                        <li class="ctype">
                            <label>Select Card Type</label>
                            <select>
                                <option>Visa</option>
                                <option>Mastercard</option>
                                <option>American Express</option>
                                <option>Maestro</option>
                                <option>Electron</option>
                            </select>
                            <span class="fa fa-cc-visa"></span>
                            <span class="fa fa-cc-mastercard"></span>
                            <span class="fa fa-cc-discover"></span>
                            <span class="fa fa-cc-amex"></span>
                            <span class="fa fa-cc-paypal"></span>
                        </li>
                        <li>
                            <label>Credit Card Number</label>
                            <input type="text" name="ccn" required minlength=15/>
                        </li>
                        <li>
                            <label>Security Code</label>
                            <input type="text" minlength=3 required/>
                            <a href="#" class="info">What's this?</a>
                        </li>
                        <li>
                            <label>Expiration Date</label>
                            <select name="month">
                                <option>month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select name="year" class="year">
                                <?php
                                for($i = 0; $i < 20; $i++){
                                    $year = date('Y') + $i;
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                            </select>
                            <select name="recurrence">
                                <option >Recurring period</option>

                            </select>
                        </li>
                        <li>
                            <label>Promotion Code</label>
                            <input type="text" />
                        </li>
                        <li>
                            <label>
                            <input type="radio" name="terms">&nbsp;
                            I agree to the <a href="#">Terms &amp; Conditions</a></label>
                        </li>
                    </ul>
                    <div class="btn-save-container">
                        <button class="btn btn-submit btn-register" type="Submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection