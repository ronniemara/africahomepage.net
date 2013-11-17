@extends('layouts.master'):

@section('content')

	<h1>Register</h1>
		{{ Form::open(array('url' => 'register')) }}
			@if($errors->any())
				<div class="alert alert-error">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
			@endif
			<ul>
				<li>
					{{ Form::label('username', 'Username') }}
					{{ Form::text('username', '', array('placeholder' => 'Username')) }}
				</li>
				<li> 
					{{ Form::label('email', 'Email') }}
					{{ Form::text('email', '', array('placeholder' => 'Email')) }}
				</li>
				<li>
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', array('placeholder' => 'Password')) }}
				</li>
				<li>
					{{ Form::label('password', 'Confirm Password') }}
					{{ Form::password('password2', array('placeholder' => 'Password')) }}
				</li>
				<li>
					{{ Form::submit('Register', array('class' =>'btn')) }}
				</li>
			</ul>
		{{ Form::close()  }}

@stop
