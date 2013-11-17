@extends('layouts.post')

@section('content')
<div class="wrapper">
	<div class="return_to_home">
	{{ HTML::link('/','Return to home') }}
	</div>
	<div class="post">
		<h4>{{ $post->title }}</h4>
		<p>
			<strong>Posted by:</strong>
				{{ $post->user->username }}
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
			<div class="comment-insert">
				<h3 class="user"> Add a comment, Ronald Marangwanda</h3>
					<div class="comment-insert-container">
						<textarea id="comment-post-text" class="comment-insert-text">
						</textarea>
					<input type="hidden" id="userId" value="1" />	
					<input type="hidden" id="postId" value="2" />	
					</div>
					<div id="comment-post-btn" class="comment-post-btn-wrapper">Post</div>
			</div>
			<div class="comments-list">
				<ul class="comment-holder-ul">
				
				@foreach ($comments as $key => $comment)
					<li class="comment-holder" id={{ $comment->id }} >
						<div class="user-pic">
							{{ HTML::image('img/photo.png','null', array('class' => 'user-img-pic')) }}						
						</div>
						<div class="comment-box">
							<h3 class="username-field">
								{{ $comment->username }}  							
							</h3>
							<div class="comment-text">
						{{ $comment->message }}	
							</div>
						</div>
						@if (Auth::check() && Auth::user()->username == $comment->username )
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
