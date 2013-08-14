@extends('master')

@section('content')

	<h1>Hello</h1>
@if(Auth::check())
<div class="header">
Welcome back, {{ Auth::user()->username }}!<br />
{{ HTML::link('logout', 'Logout') }}
</div>
@endif
<h1>All Posts</h1>

<p>{{ link_to_route('posts.create', 'Add new post') }}</p>

@if ($posts->count())
	<h2>Recent Posts</h2>
 
@foreach ($posts as $k => $v)
 
   <h3> {{ $k+1 . "." . HTML::link($v->url, $v->title) }}</h3>
	<p> Posted by: {{ HTML::link('users/'.$v->user->username, $v->user->username) }}
	
<small>{{ HTML::link('posts/'.$v->id, 'Comments') }}. {{ $v->comments->count() }}</small> 
	</p>
@endforeach       
@endif
 

@stop





