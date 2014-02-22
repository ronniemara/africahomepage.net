@extends('layouts.master')

@section('content')

	<h5> If you are not yet registered, please {{ HTML::link('register', 'Register', array('class' => 'btn btn-primary')) }} </h5>
	<h3>Login</h3>
		{{ Form::open(array('url' => 'login', 'role' =>'form')) }}


<?php

?>


				@if($errors->any())
					<div class="alert alert-warning">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</div>
				@endif

				@if(Session::has('message'))
				
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<li class="error">{{ Session::get('message') }}</li> 
					</div>
				@endif
						<div class="form-group">
							{{ Form::label('email', 'Email') }}
							{{ Form::text('email', '', array('placeholder' => 'Email', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::label('password', 'Password') }}
							{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
						{{	Form::captcha() }}
						</div>
				
						<button type="submit" class="btn btn-default">Submit</button>
						
				
			
		{{ Form::close()  }}

@stop
