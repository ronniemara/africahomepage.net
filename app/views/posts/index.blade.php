@extends('layouts.master')

@section('content')

<h1>All Posts</h1>

	<p>{{ link_to_route('posts.create', 'Add new post') }}</p>

	@if ($posts->count())
		<h2>Recent Posts</h2>
 
		@foreach ($posts as $k => $v)
                <div class="container">
                    <div class="row">
                    <div class="col-xs-1 votes">
                        <a href="#"><i class="icon-arrow-up"></i></a>
                        <a href="#"><i class="icon-arrow-down"></i></a>
                    </div>
                    <div class="col-xs-10 title-line">
                        <h4>  {{ $k+1 . ". " . HTML::link($v->url, $v->title) }}</h4>
                                    <p> Posted by: {{ $v->first_name ." ".$v->last_name}}

                                    <small>{{ HTML::link('posts/'.$v->id, $v->comments->count().'Comments') }} </small> 
                                    </p>
                    </div>
                    </div>
                </div>
                                @endforeach       
	@endif
 

@stop





