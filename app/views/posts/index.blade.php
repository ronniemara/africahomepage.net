@extends('layouts.master')

@section('content')

<h1>All Posts</h1>

<p>{{ link_to_route('posts.create', 'Add new post') }}</p>

@if ($posts->count())
	<h2>Recent Posts</h2>
 
@foreach ($posts as $k => $v)
 
   <h4> {{ $k+1 . ". " . HTML::link($v->url, $v->title) }}</h4>
	<p> Posted by: 
	
<small>{{ HTML::link('posts/'.$v->id, $v->comments->count().'Comments') }} </small> 
	</p>
@endforeach       
@endif
 

@stop





