@extends('layouts.front')

@section('content')
    <section class="pra-reg-wrap">
        <div class="pra-reg">
            <h1>Join Practicetabs</h1>
            <h2>Your all-in-one, cloud-based, practice solution.</h2>

            {!!Form::open(array('url'=>'/affiliate/saveAffiliate', 'id'=>'frm-affiliate')) !!}
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

                    <p>Fill the following information and get affiliation</p>
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
                            <label for="phone" class="label-log">Phone</label>
                            <i class="fa fa-phone key-i"></i>
                            {!! Form::text('phone', old('phone'), array('id'=>'phone')) !!}
                            @if ($errors->has('phone'))
                                <span class="pull-left text-danger error-msg">
                                        <strong>{{ $errors->first('phone') }}</strong>
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
                            <button type="submit">Join Practice Tabs</button>
                        </div>
                    </div>
                </div>
            </div>

            <p>By clicking on join button, you agree to PracticeTabs.com, <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
            {!! Form::close() !!}
        </div>

    </section>
@endsection