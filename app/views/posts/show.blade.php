@extends('layouts.default')

@section('content')

{{ HTML::link('posts', 'Return to posts') }}

<h2>{{ $post->title }}</h2>


<p>
   <strong>Posted: </strong>
@if($post->created_at->diffInHours()<25)

{{ $post->created_at->diffInHours() }} hours ago

@else

{{ $post->created_at->diffInDays() }} days ago

@endif

   by {{ $post->user->username }}
</p>
 
<hr />
 
<h3 id="comments">Comments</h3>
 
@foreach ($post->comments as $comment)
 
   <p>{{ HTML::link($comment->website, $comment->name) }} said "{{ $comment->message}}"</p>
    
@endforeach
 
<h3>Write a comment</h3>
 
{{ Form::open() }}


	<ul>
		<li>
			{{ Form::label('website', 'Website:') }}
			{{ Form::text('website') }}
		</li>

		<li>
			{{ Form::label('email', 'Email:') }}
			{{ Form::text('email') }}
		</li>

		<li>
			{{ Form::label('comment', 'Comment:') }}
			{{ Form::input('comment', 'comment') }}
		</li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn')) }}
		</li>
	</ul>

{{ Form::close() }}











