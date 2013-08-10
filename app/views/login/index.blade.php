@extends('layouts.default'):

@section('content')

<h1>Login</h1>
{{ Form::open(array('url' => 'login')) }}
	@if($errors->any())
<div class="alert alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
{{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
<ul>
<li>
{{ Form::label('username', 'Username') }}
{{ Form::text('username', '', array('placeholder' => 'Username')) }}</li>
<li> {{ Form::label('email', 'Email') }}
{{ Form::text('email', '', array('placeholder' => 'Email')) }}</li>
<li>{{ Form::label('password', 'Password') }}
{{ Form::password('password', array('placeholder' => 'Password')) }}</li>
<li>{{ Form::submit('Submit', array('class' =>'btn')) }}</li>
</ul>
{{ HTML::link('register', 'Register', array('class' => 'btn btn-primary')) }}
{{ Form::close()  }}

@if ($errors->any())
	<ul>

	</ul>	
@endif

@stop
