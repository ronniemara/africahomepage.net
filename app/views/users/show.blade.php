@extends('layouts.master')

@section('content')
<div>
	
</div>


<div class="wrapper">
	
	<div class="post">
		<h3><strong>{{ $user->first_name . " " . $user->last_name}}</strong></h3>
                <h4>Posts by user</h4>
                <table class="table-striped">
                    <th>
                    <tr>
                        <td>Id</td>
                        <td>Title</td>
                        <td>Url</td>
                        <td>Date posted</td>
                    </tr>
                    </th>
                    
                    <tbody>
                    @foreach ($user->posts as $post) 
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->url }}</td>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                    @endforeach 
                    </tbody>
                </table>
                <h4>Comments by user</h4>
                <table class="table-striped">
                    <th>
                    <tr>
                        <td>Id</td>
                        <td>Message</td>
                        <td>Date posted</td>
                    </tr>
                    </th>
                    
                    <tbody>
                    @foreach ($user->comments as $comment) 
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->message }}</td>
                        <td>{{ $comment->created_at }}</td>
                    </tr>
                    @endforeach 
                    </tbody>
                </table>
                 
	</div>
	
</div> 
@stop
