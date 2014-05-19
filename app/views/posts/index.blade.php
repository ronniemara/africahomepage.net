@extends('layouts.master')

@section('content')

<h1>All Posts</h1>

	<p>{{ link_to_route('posts.create', 'Add new post') }}</p>

	@if ($posts->count())
		<ol class="posts-ol">
                @foreach ($posts as $k => $v)
                            <li>
                                    <div class="post">
				       <h3 class="post-title"> {{ HTML::link($v->url, $v->title) }}</h3>
                                       <h5 class="post-author"> Posted by: {{ $v->first_name ." ".$v->last_name}}</h5>
				       <div class="comments-and-votes container">
						<div class="row">
							<div class="comments-div col-md-1">
								<small>{{ HTML::link('posts/'.$v->id, $v->comments->count().'Comments') }}</small>
							</div> 
							<div class="votes-div col-md-10">
								<a href="#" class="post-vote-up" id={{$v->id}}> <i class="icon-arrow-up"></i></a>
								<span class="number-of-votes" id={{$v->id}}></span> votes
								<a href="#" class="post-vote-down" id={{$v->id}}><i class="icon-arrow-down"></i></a>
							</div>
						</div>
					</div>
                                    </div>
                    
                            </li>
                    @endforeach  
                    </ol>
                
	@endif
 

@stop





