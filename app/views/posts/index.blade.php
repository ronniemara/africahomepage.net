@extends('layouts.master')

@section('content')

<h2>All Posts</h2>

	<h3>{{ link_to_route('posts.create', 'Add new post') }}</h3>

	@if ($posts->count())
		<ol class="posts-ol">
                @foreach ($posts as $k => $v)
                            <li>
                                    <div class="post">
				       <h4 class="post-title"> {{ HTML::link($v->url, $v->title) }}</h4>
                                       <h5 class="post-author"> Posted by: {{ $v->first_name ." ".$v->last_name}}</h5>
				       <div class="comments-and-votes container">
						<div class="row">
							
							<div class="comments-div col-md-1">
								<span class="icon-bubble"></span>
								<small>{{ HTML::link('posts/'.$v->id, " ".$v->comments->count()) }}</small>
							</div> 
							<div class="votes-div col-md-10">
                                                            <a href="#" class="post-vote-up" id={{$v->id}}>
                                                                <span class="icon-point-up"></span>
                                                            </a>
								<span class="number-of-votes" id={{$v->id}}></span> votes
                                                            <a href="#" class="post-vote-down" id={{$v->id}}>
                                                                <span class="icon-point-down"></span>
                                                            </a>
							</div>

						
						</div>
					</div>
                                    </div>
                    
                            </li>
                    @endforeach  
                    </ol>
                
	@endif
 

@stop





