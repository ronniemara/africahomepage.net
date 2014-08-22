@extends('layouts.master')

@section('content')
<div class="wrapper">	
	<div class="post">
	    <h3><strong>{{ HTML::link($post->url, $post->title) }}</strong></h3>
	    <p>
		    <strong>Posted by:</strong>
			    {{ $post->createdBy }}
		    <em>{{ $post->time_ago }}</em>
	    </p>
	    <div class="votes-div">
                <a href="#" class="post-vote-up" id={{$post->id}}>
                    <span class="icon-point-up"></span>
                </a>
                    <span class="number-of-votes" id={{$post->id}}></span> votes
                <a href="#" class="post-vote-down" id={{$post->id}}>
                    <span class="icon-point-down"></span>
                </a>            
                               		<!--<a href="#" class="post-vote-up" id={{$post->id}}> <i class="icon-arrow-up"></i></a>
		<span class="number-of-votes" id={{$post->id}}></span> votes
		<a href="#" class="post-vote-down" id={{$post->id}}><i class="icon-arrow-down"></i></a> -->
	    </div>
	</div>
	<div class="comment-wrapper">
		<h4 id="comments">Comments</h4>
		@if (Sentry::check()) 
		<div class="comment-insert">
			<h3 class="user"> Add a comment, {{ Session::get('currentUserName') }}</h3>
			<div class="comment-insert-container">
				<textarea id="comment-post-text" class="comment-insert-text">
				</textarea>
				<input type="hidden" id="userId" value= {{ Sentry::getId() }} />	
				<input type="hidden" id="postId" value= {{ $post->id }} />	
			</div>
			<div id="comment-post-btn" class="comment-post-btn-wrapper">
				Post
			</div>
		</div>
		@else
		<div class="login-to-comment">
			<h5>To post comments please {{ HTML::link('/login', 'login') }}</h5>
		</div>
		@endif
		<div class="comments-list">
			<ul class="comment-holder-ul">			
				@foreach ($comments as $key => $comment)
					<li class="comment-holder" id={{ $comment->id }} >
						<div class="user-pic">
							{{ HTML::image('img/photo.png','null', array('class' => 'user-img-pic')) }}				
						</div>
						<div class="comment-box">
							<div class="comment-text">
								<div>  
								   <h3 class="username-field" > {{ $comment->createdBy }} </h3>					
								</div>							
								<div class="show-post-comments-and-votes col-md-12 ">
									<div>
										{{ $comment->message }}
									</div>	
									<div class="votes-paragraph">
									    <a href="#" class="comment-vote-up" id={{$comment->id}} > 
										<i class="icon-arrow-up"></i>
									    </a>
									    <span class="number-of-votes" id={{$comment->id}}></span> votes
									    <a href="#" class="comment-vote-down" id={{$comment->id}}>
										<i class="icon-arrow-down"></i>
									    </a>
									</div>
								 </div>						
							</div>
						</div>
						@if (Sentry::check() && Sentry::getId() == $comment->user_id )
						<div class="comment-buttons-holder">
							<ul>
								<li id={{ $comment->id }} class="delete-btn">
									X
								</li>
							</ul>
						</div>
						@endif
					</li>
				@endforeach				
			</ul>
		</div>
	</div>
</div> 
@stop
