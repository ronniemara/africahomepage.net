@extends('layouts.default')

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

@if (!empty($posts))
	<h2>Recent Posts</h2>
 
@foreach ($posts as $k => $v)
 
   <h3> {{ $k . "." . HTML::link('posts/'.$v['id'], $v['title']) }}</h3>
	<p>{{ $v->user->username }}
@endforeach       
@endif
 

@stop
