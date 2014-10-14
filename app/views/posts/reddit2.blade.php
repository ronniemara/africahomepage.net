@extends('layouts.bootstrap')

@section('content')
<div class='col-md-8 col-md-offset-2' ng-controller="HelloController as post">
    
        <div>
            <h1><a href={{post.posts.url}}>{{post.posts.title}}</a></h1>
            <h1>{{}}</h1>
            <h3>{{post.posts.by}}</h3>
            <em>{{post.posts.on}}</em>
            <p>
                <a href="votes">{{post.posts.votes}}</a>
            </p>
            <a href="comments">{{post.posts.comments}}</a>
            
        </div>
    
</div>

@stop
