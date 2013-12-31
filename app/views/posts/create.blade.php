@extends('layouts.master')

@section('content')

<h1>Create Post</h1>

@if(Sentry::check())
	{{ Form::open(array('route' => 'posts.store')) }}
		<ul>
			<li>
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title') }}
			</li>

			<li>
				{{ Form::label('url', 'Url:') }}
				{{ Form::text('url') }}
			</li>

			<li>
				{{ Form::label('karma', 'Karma:') }}
				{{ Form::input('number', 'karma') }}
			</li>

			<li>
				{{ Form::submit('Submit', array('class' => 'btn')) }}
			</li>
		</ul>
	{{ Form::close() }}
@else
	<div class="login-to-comment">You must {{ HTML::link('/login', 'login') }}, in order to post entries.</div>
@endif

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


