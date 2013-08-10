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

@if ($posts->count())
	<h2>Recent Posts</h2>
 
@foreach ($posts as $post)
 
   <h3>{{ HTML::link('posts/'.$post->id, $post->title) }}</h3>
	<p>{{ $post->user->username }}
@endforeach       
@endif
 

@stop
