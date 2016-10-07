@extends('layouts.pradash')

@section('content')
    <br/>
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            {!! Form::open(array('url'=>'/practitioner/index/savePatient', 'class'=>'form-horizontal'))!!}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>New Patient</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('first_name','First Name:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('first_name', null, array('id'=> 'first_name','class'=>'form-control')) !!}
                            @if ($errors->has('first_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name','Last Name:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('last_name', null, array('id'=> 'last_name','class'=>'form-control')) !!}
                            @if ($errors->has('last_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email','Email:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', null, array('id'=> 'email','class'=>'form-control')) !!}
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone','Phone:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('phone', null, array('id'=> 'phone','class'=>'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('cell','Cell:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('cell', null, array('id'=> 'cell','class'=>'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('gender','Gender:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                            {!! Form::select('gender', array(null=>'Select', '0' => 'Male', '1' => 'Female'), null, array('class'=>'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address','Address:', array('class'=>'col-sm-3')) !!}
                        <div class="col-sm-9">
                        {!! Form::textarea('address', null, array('id'=> 'address','class'=>'form-control', 'rows'=>'3')) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Save', array('class'=>'btn btn-lg btn-success pull-right')) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
@endsection