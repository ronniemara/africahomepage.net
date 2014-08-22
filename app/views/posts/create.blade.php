@extends('layouts.master')

@section('content')

<h1>Create Post</h1>

@if(Sentry::check())

		{{ Form::open(array('route' => 'posts.store')) }}
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
							{{ Form::label('title', 'Title') }}
							{{ Form::text('title', '', array('placeholder' => 'Title', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::label('url', 'Url') }}
							{{ Form::text('url', '', array('placeholder' => 'Url', 'class' => 'form-control')) }}
						</div>
			
				
						<button type="submit" class="btn btn-default">Submit</button>
		{{ Form::close()  }}

@else
	<div class="login-to-comment">You must {{ HTML::link('/login', 'login') }}, in order to post entries.</div>
@endif

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


