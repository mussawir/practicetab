@extends('layouts.front')

@section('content')
    <section class="login-wrap">
        <div class="pra-reg">
            <h1>Affiliated Member Login</h1>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                <div class="box">
                    <div style="padding-top: 50px;"></div>
                    @if(Session::has('warning'))
                        <div class="alert alert-warning">
                            <strong>{{Session::get('warning')}}</strong>
                        </div>
                    @endif
                        <div class="row-reg not-reg {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="block-inp">
                            <label class="label-log">E-Mail Address</label>
                                <i class="fa fa-envelope key-i"></i>
                                <input type="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row-reg not-reg {{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="block-inp">
                            <label class="label-log">Password</label>
                                <i class="fa fa-key key-i"></i>
                                <input type="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>--}}

                        <div class="row-reg not-reg">
                            <div class="btn sub-reg text-center">
                                <button type="submit">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                            <p>
                                <a class="pull-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </p>
                        </div>
                </div>
            </form>
        </div>
    </section>
@endsection