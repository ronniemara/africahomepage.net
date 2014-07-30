@extends('layouts.master'):

@section('content')

	<h1>Register</h1>
		{{ Form::open(array('url' => 'register', 'role' => 'form')) }}
			@if($errors->any())
				<div class="alert alert-warning">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
            			<div class="form-group"> 
					{{ Form::label('first_name', 'First Name') }}
					{{ Form::text('first_name', '', array('placeholder' => 'First Name', 'class'=> 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('last_name', 'Last Name') }}
					{{ Form::text('last_name', '', array('placeholder' => 'Last Name','class'=> 'form-control')) }}
				</div>
                                <div class="form-group">
					{{ Form::label('user_name', 'Username') }}
					{{ Form::text('user_name', '', array('placeholder' => 'Username','class'=> 'form-control')) }}
				</div>
				<div class="form-group"> 
					{{ Form::label('email', 'Email') }}
					{{ Form::text('email', '', array('placeholder' => 'Email','class'=> 'form-control')) }}
				</div>
				<div class="form-group"> 
					{{ Form::label('email', 'Confirm Email') }}
					{{ Form::text('email2', '', array('placeholder' => 'Email','class'=> 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', array('placeholder' => 'Password','class'=> 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('password', 'Confirm Password') }}
					{{ Form::password('password2', array('placeholder' => 'Password','class'=> 'form-control')) }}
						<div class="form-group">
							{{ Form::captcha() }}
						</div>
				</div>
				
				<button type="submit" class="btn btn-default">Submit</button>
					
				
			
		{{ Form::close()  }}

@stop
