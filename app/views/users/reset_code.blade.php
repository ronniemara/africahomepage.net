@extends('layouts.master')
@section('content')
    <h3>Reset Password</h3>
        {{ Form::open(array('url' => 'password-form', 'role' =>'form')) }}
            <div class="form-group">
                    {{ Form::label('email', 'Enter your email address') }}
                    {{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        {{ Form::close()  }}
@stop
