
<div class="pull-right">
    <h2>Connect with Us</h2> 
    <aside class="well sidebar-nav ">

        <a href="https://twitter.com/africahomepage" class="btn btn-social-icon btn-twitter"><i class="icon icon-twitter"></i></a>
        <a href="https://plus.google.com/+AfricahomepageNet" class="btn btn-social-icon btn-google-plus" rel="publisher"><i class="icon-googleplus"></i></a>                                                  
        <a href="https://facebook.com/africahomepage" class="btn btn-social-icon btn-facebook"><i class="icon icon-facebook"></i></a>                 
    </aside><!--/.well -->
</div>
<div>
    <h4 class="post-title"><a href="#/posts/{{post.id}}">{{post.title}}</a></h4>
    <h5 class="post-author"> Posted by: <strong>{{post.author}}</strong> <i>{{post.created_at | time-ago}}</i></h5>       
    <div class="comments-and-votes container">
        <div class="row">							
            <div class="comments-div col-md-1">
                <span class="icon-bubble"></span>
                <small>35</small>
            </div> 
            <div class="votes-div col-md-10">
                <a href="#" class="post-vote-up" id=1>
                    <span class="icon-point-up"></span>
                </a>
                <span class="number-of-votes" id=1></span> votes
                <a href="#" class="post-vote-down" id=1>
                    <span class="icon-point-down"></span>
                </a>
            </div>						
        </div>
    </div>
</div>

