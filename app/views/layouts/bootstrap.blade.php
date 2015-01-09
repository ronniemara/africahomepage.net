<!DOCTYPE html>
<html lang="en" ng-app="myapp">
    <head>
	<meta charset="utf-8">
	<title>AfricaHomepage.net</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="/css/bootstrap.min.css?{{ time()}}" rel="stylesheet" media="screen">     
	<link href="/css/font-awesome.min.css?{{ time()}}" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-social.css?{{ time()}}" rel="stylesheet" media="screen">

	<style type="text/css">
	    body {
		padding-top: 60px;
		padding-bottom: 40px;

	    }
	    .sidebar-nav {
		padding: 9px 0;
	    }

	    @media (max-width: 980px) {
		/* Enable use of floated navbar text */
		.navbar-text.pull-right {
		    float: none;
		    padding-left: 5px;
		    padding-right: 5px;
		}
	    }
	</style>
	<link href="/css/icons.css?<?php echo time(); ?>" rel="stylesheet" media="screen">
	<link href="/css/mystyle.css?<?php echo time(); ?>" rel="stylesheet" media="screen">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="../assets/js/html5shiv.js"></script>
	<![endif]-->

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../assets/ico/favicon.png">
        <base href="/">
    </head>
    <body >
	<div class="container-fluid"  ng-controller="PanelCtrl">
	    <header>
		<div class="panel">
		    <h1 class="col-md-offset-3">
			<a href="#" style="text-decoration: none;">
			    <span class="icon-africa"></span>AfricaHomepage
			</a>
		    </h1>
		</div>
		<nav class="navbar navbar-default " role="navigation" style="margin-top: -21px;">
		    <div class="container-fluid">
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			    </button>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
			    <ul class="nav navbar-nav" >
				<li ng-class="{active: $state.includes('posts')}"><a ui-sref="posts" >Posts</a></li>
			    </ul>            
			    <div class="pull-right">
				<div class="navbar-right pull-right" ng-if="user.isLoggedIn" >
                                    <p>
					Logged in as <cite><a class="navbar-link">{{user.username}}</a></cite>
                                    <a><button ng-click="logout()">Logout</button></a>
				    </p>   

				</div>                                
				<ul class=" nav navbar-nav" ng-if="!user.isLoggedIn">
				    <li ng-class="{active: $state.includes('login')}"><a ui-sref="login">Login</a></li> 
				</ul>
			    </div>
			</div><!--/.nav-collapse -->
		    </div>
		</nav>
	    </header>
		<div class="row-fluid">
                        <div class="col-xs-12 col-md-9">
                            <mc-messages></mc-messages>
                            <div data-ui-view  auto-scroll="true">
                                Loading...
                            </div>
                        </div>
			<aside class="col-xs-12 col-md-3 well">
			    <h3>Connect with Us</h3>
				<a href="https://plus.google.com/+AfricahomepageNet" rel="publisher"> <i class="fa fa-google-plus fa-3x"></i></a>
                                <a href="https://www.twitter.com/africahomepage">
                                    <i class="fa fa-twitter-square fa-3x"></i>
                                </a>	
                        </aside>
		</div>
<footer class="panel">
    <p> <i class="fa fa-copyright"></i> 2014 Black Mirror Media</p>
</footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    
    <script src="/js/jquery-1.11.0.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/angular.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/angular-ui-router.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/angular-resource.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/angular-timeago.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/angular-idle.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="/js/message-center.js?<?php echo time(); ?>" ></script>
    <script src="/js/ui-bootstrap-tpls-0.11.2.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/lodash.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/restangular.min.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/app.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/controllers.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script src="/js/directives.js?<?php echo time(); ?>" type="text/javascript"></script>
<script src="/js/posts/posts.js?<?php echo time(); ?>" type="text/javascript"></script>
<script src="/js/posts/posts-service.js?<?php echo time(); ?>" type="text/javascript"></script>
<script src="/js/utils-service.js?<?php echo time(); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="//www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
    <script type="text/javascript" src="/js/angular-recaptcha.js?<?php echo time(); ?>"></script>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57798045-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
