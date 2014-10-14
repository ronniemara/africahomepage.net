@extends('layouts.bootstrap')

@section('content')


<div class='col-md-5 col-md-offset-2'>
    <h2>All Posts</h2>

    <div ng-controller="PostsListCtrl as articles">
        <ul class="list-group">
            <li class="list-group-item" ng-repeat="post in posts">
         
            <h3><a href={{post.url}}>{{post.title}}</a></h3>   
            <em>
                {{ post.created_at | timeAgo }}
            </em>
            <div>
                <img>
                50 Votes
                <img>
                <em>40</em>Comments 
                <p>Add a Comment</p>
            </div>
            </ul>
        </div>
        
        
    </div>
</div>
<div class='col-md-3'>
    @include('partials.social-media')
</div>


@stop





