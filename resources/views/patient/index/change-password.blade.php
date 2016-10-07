@extends('layouts.padash')

@section('content')
    <div class="row" style="padding: 50px 0;">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong>{{Session::pull('success')}}</strong>
                </div>
            @endif
            <div id="msg" style="display: none;"></div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Change Password</h2>
                </div>

                <div class="panel-body">
                    <form id="frm-pc" class="form-horizontal" role="form" method="POST" action="{{ url('/patient/index/saveNewPassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" id="old-password" name="old_password">

                                @if ($errors->has('old_password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" id="new-password" name="new_password">

                                @if ($errors->has('new_password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="con-password" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="btn-cp" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-floppy-o"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection