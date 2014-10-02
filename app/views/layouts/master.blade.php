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
                
                    <div class="mylogo hidden-xs hidden-sm ">
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
                                        <a href="/user/logout">Logout</a></p>
                                    </div>
				</div><!-- end col-md-3 -->
                            @else
				<div class="col-md-12 logo">
		                        <h1>
		                            <a href="/"><span class="icon-africa"></span>Homepage Africa</a>
		                        </h1>
                        	</div><!-- end main-content-area -->
				
                            @endif      					
                    </div><!-- end of mylogo -->
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button> 
                                <a href="/" class="hidden-lg hidden-sm hidden-md" ><span class="icon-africa"></span>Homepage Africa</a>
                             </div>                           
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> <!-- Collect the nav links, forms, and other content for toggling -->
                                <ul class="nav navbar-nav">
                                    <li>{{ HTML::link('/opinion', 'Opinion') }}</li>
                                    <li>{{ HTML::link('/posts', 'Posts') }}</li>   
                                    
                                </ul>
                                <ul class="nav navbar-nav navbar-right"><li>{{ HTML::link('/login', 'Login') }}</li></ul>
                            </div>
                        </div>

                    </nav>
                
            </header> <!-- end header -->
            <div class="container-fluid"><!-- MAIN BODY -->
                <div class="row-fluid" style="background-color: white">
                    <aside class="col-md-3  col-xs-6 sidebar pull-right">
                        <div class="sidebar-widget ">
                            <h2>Connect with Us</h2>
                                <a href="https://twitter.com/africahomepage" ><span style="color:black;" class="icon-twitter"></span> </a>
                                <a href="https://plus.google.com/+AfricahomepageNet" rel="publisher"><span style="color:black;" class="icon-googleplus"></span></a>                                
                                <a href="https://facebook.com/africahomepage" ><span style="color:black;" class="icon-facebook"></span> </a>
                        </div>                        
                    </aside><!-- end of aside -->
                    <div class="col-md-9 col-xs-6 main-content-area">
                        @yield('content')
                    </div><!-- end main-content-area -->
                    
                </div><!-- main area -->
            </div><!-- container -->
            <div class="row-fluid">
                <footer>
                                <p style="color: white;">&copy; 2013 Black Mirror Media</p>
                                
                                    @if (isset($check_user))
                                    @if($check_user->hasPermission(array('_superadmin', '_user-editor','_group-editor', '_permissions-editor','_profile-editor')))
                                    {{ HTML::link('/admin/login', 'Admin') }}
                    @endif
                    @endif

                </footer> <!-- end footer div -->
            </div>
	</body>
       
</html>


















