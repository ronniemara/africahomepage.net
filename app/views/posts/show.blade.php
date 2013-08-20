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


 <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'nkrumahsvision'; // required: replace example with your forum shortname

	        /* * * DON'T EDIT BELOW THIS LINE * * */
	        (function() {
			            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						        })();
	    </script>
		        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
			        















