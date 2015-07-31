@extends('layouts.master')
@section('content')
    <h3>New Password</h3>
        {{ Form::open(array('url' => 'reset', 'role' =>'form')) }}
            <div class="form-group">
                    {{ Form::label('email', 'Enter your email address') }}
                    {{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
            </div>
            <div class="form-group">
                    {{ Form::label('password', 'Enter your new password') }}
                    {{ Form::password('password', '', array('placeholder' => 'Password', 'class' => 'form-control')) }}
            </div>
            <div class="form-group">
                    {{ Form::label('password-repeat', 'Confirm your new password') }}
                    {{ Form::password('password-repeat', '', array('placeholder' => 'Confirm password', 'class' => 'form-control')) }}
            </div>
            <div>
                <input type="hidden" name="code" value="{{ $resetCode }}">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        {{ Form::close()  }}
@stop
