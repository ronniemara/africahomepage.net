<!DOCTYPE html>
<html>
	<head>
		<title>AfricaHomepage.net</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="/css/bootstrap.min.css?{{ time() }}" rel="stylesheet" media="screen">
		<link href="/css/font-awesome.min.css?{{ time() }}" rel="stylesheet" media="screen">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet" media="screen">
		<link href="/css/mystyle.css?<?php echo time(); ?>" rel="stylesheet" media="screen">
                <link href="/css/icons.css?<?php echo time(); ?>" rel="stylesheet" media="screen">
                <script src="/js/jquery-1.11.0.js?<?php echo time(); ?>" type="text/javascript"></script>		
                <script src="/js/bootstrap.min.js?<?php echo time(); ?>" type="text/javascript"></script>
                <script src="/js/comment_post_script.js?<?php echo time(); ?>" type="text/javascript" ></script>
                <script src="/js/comment_delete_script.js?<?php echo time(); ?>" type="text/javascript"></script>
                <script src="/js/post_vote_script.js?<?php echo time(); ?>" type="text/javascript"></script>
		
	</head>
	<body>
            <header><!--HEADER -->
                <div class="container">
                    <div class="mylogo">
                           @if (Sentry::check())
				<div class="col-md-6 logo">
		                        <h1>
		                            <a href="/">
		                                <span class="icon-africa"></span> AfricaHomepage
		                            </a>
		                        </h1>
                        	</div><!-- end main-content-area -->
				<div class="col-md-6 login-link">
                                    <div class="signed-in-as">
                                        <p class="navbar-text">Signed in as {{ Session::get('currentUserName') }}
                                        <a href="/logout">Logout</a></p>
                                    </div>
				</div><!-- end col-md-3 -->
                            @else
				<div class="col-md-9 logo">
		                        <h1>
		                            <a href="/">
		                                <span class="icon-africa"></span> Homepage Africa
		                            </a>
		                        </h1>
                        	</div><!-- end main-content-area -->
				<div class="col-md-3 login-link">						
		                                 <h1><a href="/login">Login</a></h1> 
				</div><!-- end col-md-3 -->
                            @endif      					
                    </div><!-- end of mylogo -->
                </div><!-- container -->
            </header> <!-- end header -->
            <div class="container"><!-- MAIN BODY -->
                <div class="main-area">
                    <div class="col-md-9 main-content-area">
                        @yield('content')
                    </div><!-- end main-content-area -->
                    <aside class="col-md-3 sidebar">
                        <div class="sidebar-widget">
                            <h2>Connect with Us</h2>
                                <a href="https://twitter.com/africahomepage" ><span style="color:black;" class="icon-twitter"></span> </a>
                                <a href="https://plus.google.com/101725105360299569055" rel="publisher"><span style="color:black;" class="icon-googleplus"></span></a>                                
                                <a href="https://facebook.com/africahomepage" ><span style="color:black;" class="icon-facebook"></span> </a>
                        </div>                        
                    </aside><!-- end of aside -->
                </div><!-- main area -->
            </div><!-- container -->
            <div class="container">
                <footer>
                                <p style="color: white;">&copy; 2013 Black Mirror Media</p>
                </footer> <!-- end footer div -->
            </div>
	</body>
</html>


















