@extends('layouts.bootstrap')

@section('content')
<div class='col-md-8 col-md-offset-2'>
    <div data-fullname="t3_2i0pq1" onclick="click_thing(this)" class=" thing id-t3_2i0pq1 even  link ">
    <p class="parent"></p>
    <span class="rank">2</span>
    <div class="midcol unvoted">
        <div tabindex="0" aria-label="upvote" role="button" onclick="$(this).vote(r.config.vote_hash, null, event)" class="arrow up login-required">
            
        </div>
        <div class="score dislikes">4530</div>
        <div class="score unvoted">4531</div>
        <div class="score likes">4532</div>
        <div tabindex="0" aria-label="downvote" role="button" onclick="$(this).vote(r.config.vote_hash, null, event)" class="arrow down login-required"></div>
            
    </div>
    <div class="entry unvoted">
        <p class="title">
            <a tabindex="1" href="http://thinkprogress.org/education/2014/10/01/3574551/germany-free-college-tuition/" class="title may-blank ">Germany Just Abolished College Tuition Fees | ThinkProgress</a> 
            <span class="domain">(<a href="/domain/thinkprogress.org/">thinkprogress.org</a>)</span>
        </p>
        <p class="tagline">submitted <time class="live-timestamp" datetime="2014-10-01T19:26:42+00:00" title="Wed Oct 1 19:26:42 2014 UTC">8 hours ago</time>
            by <a class="author may-blank id-t2_3sjyi" href="http://www.reddit.com/user/bloggy75">bloggy75</a>
            <span class="userattrs"></span> 
            to <a class="subreddit hover may-blank" href="http://www.reddit.com/r/worldnews/">/r/worldnews</a>
        </p>
        <ul class="flat-list buttons">
            <li class="first">
                <a class="comments may-blank" href="http://www.reddit.com/r/worldnews/comments/2i0pq1/germany_just_abolished_college_tuition_fees/">2388 comments</a></li>
            <li class="share">
                <span style="" class="share-button toggle">
                    <a tabindex="100" href="#" class="option active login-required">share</a>
                    <a href="#" class="option ">cancel</a>
                </span>
            </li>
        </ul>
        <div style="display: none" class="expando">
            <span class="error">loading...</span>
        </div>
    </div>
    <div class="child">
        
    </div>
    <div class="clearleft"></div>
        
</div>
    
</div>

@stop
