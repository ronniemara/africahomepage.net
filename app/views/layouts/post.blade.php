<!DOCTYPE html>
<html>
	<head>
		<title>Nkrumah&#39;s Vision</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="/css/font-awesome.min.css" rel="stylesheet" media="screen">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link href="/css/mystyle.css" rel="stylesheet" media="screen">
		{{ HTML::script('//underscorejs.org/underscore.js') }}
		{{ HTML::script('//code.jquery.com/jquery.js') }}
			<script>
			if (typeof jQuery == 'undefined') {
				    document.write(unescape("%3Cscript src='/js/jquery-1.10.2.js' type='text/javascript'%3E%3C/script%3E"));
			}
			</script>
		{{ HTML::script('//backbonejs.org/backbone-min.js') }}
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/post_script.js" ></script>
                <script src="/js/delete_script.js"></script>
		{{ HTML::script('js/app.js') }}

	</head>
	<body>

		<!--HEADER -->

		<header>
		<div class="container">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  			<!-- Brand and toggle get grouped for better mobile display -->
  				<div class="navbar-header">
    				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	      				<span class="sr-only">Toggle navigation</span>
	      				<span class="icon-bar"></span>
	      				<span class="icon-bar"></span>
	      				<span class="icon-bar"></span>
    				</button>
    				<a class="navbar-brand" href="#">Nkrumahs Vision</a>
  				</div>

  			<!-- Collect the nav links, forms, and other content for toggling -->
  				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    				<ul class="nav navbar-nav">
					      <li class="active"><a href="#">Link</a></li>
					
					
					</ul>
    				
    				
      							@if (Sentry::check())
      							<p class="navbar-text">Signed in as {{ Session::get('currentUserName') }}</p>
								<a href="/logout">Logout</a>
								@else
									<a href="/login"><button class="navabar-btn">Login</button></a>
								@endif
      					
    				
  				</div><!-- /.navbar-collapse -->
			</nav>
		</header> 
		
		<!-- MAIN BODY -->
			<div class="container main-area">
				<div class="row">
					<div class="col-md-9 main-content-area container">
						@yield('content')
					</div><!-- end main-content-area -->
					<aside class="col-md-3 sidebar">
						<div class="sidebar-widget">
							<h4>Connect with Us</h4>
							<a href="https://twitter.com/nkrumahsvision" ><i style="color:black;" class="icon-twitter icon-2x"></i> </a>
							<a href="https://plus.google.com/nkrumahsvision" ><i style="color:black;" class="icon-google-plus icon-2x"></i> </a>
							<a href="https://facebook.com/nkrumahsvision" ><i style="color:black;" class="icon-facebook icon-2x"></i> </a>
						</div>
						<div class="sidebar-widget clearfix">
							Advertisement
							<figure>
								<img src="http://lorempixel.com/140/140" class="img-rounded">
							</figure>
						</div>
					</aside><!-- end of aside -->
				</div><!-- row -->
			</div><!-- main area -->
			<footer>
				<div class="container">
					<p style="color: white;">&copy; 2013 Black Mirror Media</p>
				</div>
			</footer> <!-- end footer div -->
		</body>
</html>
