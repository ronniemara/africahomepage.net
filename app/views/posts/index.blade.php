@extends('layouts.master')

@section('content')

<h1>All Posts</h1>

	<p>{{ link_to_route('posts.create', 'Add new post') }}</p>

	@if ($posts->count())
		<ol class="posts-ol">
                @foreach ($posts as $k => $v)
                            <li>
                                {{ HTML::link($v->url, $v->title) }}
                                    <p> 
                                        Posted by: {{ $v->first_name ." ".$v->last_name}}

                                        <small>
                                            {{ HTML::link('posts/'.$v->id, $v->comments->count().'Comments') }}
                                        </small> 
                                    </p>
                                    <p class="votes-paragraph">
                                        <a href="#" class="post-vote-up" id={{$v->id}}> <i class="icon-arrow-up"></i></a>
                                        <span class="number-of-votes" id={{$v->id}}></span> votes
                                        <a href="#" class="post-vote-down" id={{$v->id}}><i class="icon-arrow-down"></i></a>
                                    </p>
                    
                            </li>
                    @endforeach  
                    </ol>
                
	@endif
 

@stop





