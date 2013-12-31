@extends('layouts.master')

@section('content')

<h1>Comments</h1>

	{{ Form::open(array('url' => 'comments')) }}

		{{ Form::label('comment') }}
		{{ Form::textarea('message') }}
		{{ Form::label('userId') }}
		{{ Form::text('user_id') }}
		{{ Form::label('postId') }}
		{{ Form::text('post_id') }}
		{{ Form::submit()}}


	{{ Form::close() }}

@stop


