@extends('layouts.front')

@section('content')
    <section class="pra-reg-wrap">
        <div class="pra-reg">
            <h1>Join Practicetabs</h1>
            <h2>Your all-in-one, cloud-based, practice solution.</h2>

            @if(($plan_type != NULL) && ($plan_type=='Free'))
                {!!Form::open(array('url'=>'/registration/savePractitioner', 'id'=>'pra-reg-form')) !!}
            @elseif(($plan_type != NULL) && ($plan_type=='Premium' || $plan_type=='Lite'))
                {!!Form::open(array('url'=>'/registration/account/payment', 'id'=>'pra-reg-form')) !!}
            @endif
            <div class="box">
                <div id="step_1">
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
                    @if($plan_type==NULL)
                        <h2 class="text-danger">Please choose a plan first</h2>
                    @else
                        <h2>You choose the {{$plan_type}} plan</h2>
                    @endif
                    <p>First step of the registration process</p>
                    <div class="row-reg not-reg">
                        <div class="block-inp">
                            <label for="first-name" class="label-log">First Name</label>
                            <i class="fa fa-user key-i"></i>
                            {!!Form::text('first_name', old('first_name'), array('id'=>'first-name')) !!}
                            @if ($errors->has('first_name'))
                                <span class="pull-left text-danger error-msg">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row-reg not-reg">
                        <div class="block-inp">
                            <label for="last-name" class="label-log">Last Name</label>
                            <i class="fa fa-user key-i"></i>
                            {!! Form::text('last_name', old('last_name'), array('id'=>'last-name')) !!}
                            @if ($errors->has('last_name'))
                                <span class="pull-left text-danger error-msg">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row-reg not-reg">
                        <div class="block-inp">
                            <label for="email" class="label-log">Email</label>
                            <i class="fa fa-envelope key-i"></i>
                            {!! Form::email('email', old('email'), array('id'=>'email')) !!}
                            @if ($errors->has('email'))
                                <span class="pull-left text-danger error-msg">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 btn sub-reg">
                            <button type="submit"><?php if(($plan_type != NULL) && ($plan_type!='Free')) echo 'Next >>'; else echo 'Join PracticeTabs';?></button>
                        </div>
                    </div>
                </div>
            </div>

            <p>By clicking on join button, you agree to PracticeTabs.com, <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
            {!! Form::close() !!}
        </div>
        <div class="footnotes">
            <p>* $199.95 Initial setup fee for Premium account holders. This one-time cost includes data transfer, merchant account setup fee and merchant account equipment.</p>
            <p>* Save 10% with annual pre-paymentt</p>
            <p>* Save 5% with semi-annual pre-payment</p>
            <p>† Secure cloud storage - 5GB included in Premium plan.</p>
            <p>‡ Email marketing includes up to 5,000 emails per month.</p>
        </div>

        <div class="footerCTA">
            <p class="questionsCTA">Call <b>+1 800 555 5555</b> or <b>Contact Us</b> with your questions.</p>
            <p class="questionsCTA2">Customer service included with all plans.</p>
        </div>
    </section>
@endsection