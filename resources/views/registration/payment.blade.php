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
    <section class="login-wrap" style="margin-bottom: 50px; background-size: 100% 60%;">
        <div class="pra-reg">
            <h1>Join Practicetabs</h1>
            <h2>Your all-in-one, cloud-based, practice solution.</h2>

            <form method="post" action="{{url('/registration/saveAccountPayment')}}" class="add-patient register" style="width: 95%;">
                {{ csrf_field() }}
                <div class="first-section box">
                    <h2>Almost Done!</h2>
                    <p>You choose the <strong>{{$plan_type}}</strong> Plan.</p>
                    <p>Enter your billing information below to get started with PracticeTabs!</p>
                    <ul>
                        <li class="ctype">
                            <label>Select Card Type</label>
                                {!! Form::select('cc_type',array(
                                    "Visa"=>"Visa",
                                    "Mastercard"=>"Mastercard",
                                    "American Express"=>"American Express",
                                    "Maestro"=>"Maestro",
                                    "Electron"=>"Electron"
                                ), old('cc_type'), array()) !!}

                                <span class="fa fa-cc-visa"></span>
                                <span class="fa fa-cc-mastercard"></span>
                                <span class="fa fa-cc-discover"></span>
                                <span class="fa fa-cc-amex"></span>
                                <span class="fa fa-cc-paypal"></span>
                            </li>
                            <li>
                                <label>Credit Card Number</label> {{-- '4111-1111-1111-1111' --}}
                                <input type="text" name="cc_number" value="{{old('cc_number')}}"  minlength="15" autocomplete="off" />
                                @if ($errors->has('cc_number'))
                                    <span class="pull-left text-danger error-msg">
                                            <strong>{{ $errors->first('cc_number') }}</strong>
                                        </span>
                                @endif
                            </li>
                            <li>
                                <label>Security Code</label>
                                <input type="text" name="cc_cvv" value="{{old('cc_cvv')}}" minlength="3" />
                                <a href="#" class="info">What's this?</a>
                                @if ($errors->has('cc_cvv'))
                                    <span class="pull-left text-danger error-msg" style="width: 50%;">
                                            <strong>{{ $errors->first('cc_cvv') }}</strong>
                                    </span>
                                @endif
                            </li>
                            <li>
                                <label>Expiration Date</label>
                                {!! Form::select('cc_month',array(
                                    "01"=>"January",
                                    "02"=>"February",
                                    "03"=>"March",
                                    "04"=>"April",
                                    "05"=>"May",
                                    "06"=>"June",
                                    "07"=>"July",
                                    "08"=>"August",
                                    "09"=>"September",
                                    "10"=>"October",
                                    "11"=>"November",
                                    "12"=>"December"
                                ), old('cc_month'), array()) !!}

                                <select name="cc_year" class="year">
                                    <?php
                                    for($i = 0; $i < 20; $i++){
                                        $year = date('Y') + $i;
                                        echo '<option value="' . $year . '" '.($year==old('cc_year') ? 'selected' : '').'>' . $year . '</option>';
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
                                <input type="checkbox" name="terms" {{old('terms')=='on' ? 'checked' : ''}}>&nbsp;
                                I agree to the <a href="#">Terms &amp; Conditions</a></label>
                                @if ($errors->has('terms'))
                                    <span class="pull-left text-danger error-msg">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </span>
                                @endif
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-md-12">
                        <div class="btn-save-container">
                            <button class="btn btn-submit btn-register" type="Submit">Register</button>
                        </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @endsection