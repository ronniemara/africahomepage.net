@extends('layouts.master')

@section('content')
<div>
	
</div>


<div class="wrapper">
	
	<div class="post">
		<h3><strong>{{ $post->title }}</strong></h3>
		<p>
			<strong>Posted by:</strong>
				{{ $post->createdBy }}
				
			<em>
				@if($post->created_at->diffInHours()<25)
					{{ $post->created_at->diffInHours() }} hours ago
				@else
					{{ $post->created_at->diffInDays() }} days ago
				@endif
			</em>
		</p>	
	</div>
	<div class="comment-wrapper">
		<h4 id="comments">Comments</h4>
			@if(Sentry::check()) 
				<div class="comment-insert">
					<h3 class="user"> Add a comment, {{ Session::get('currentUserName') }}</h3>
						<div class="comment-insert-container">
							<textarea id="comment-post-text" class="comment-insert-text">
							</textarea>
						<input type="hidden" id="userId" value={{ Sentry::getId() }} />	
						<input type="hidden" id="postId" value={{ $post->id }} />	
						</div>
						<div id="comment-post-btn" class="comment-post-btn-wrapper">Post</div>
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
							<h3 class="username-field">
								{{ $comment->createdBy }}  							
							</h3>
							<div class="comment-text">
						{{ $comment->message }}	
							</div>
						</div>
						@if (Sentry::check() && Sentry::getId() == $comment->user_id )
						<div class="comment-buttons-holder">
						<ul>
							<li id={{ $comment->id }} class="delete-btn">X
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
