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
        
    </head>
    <body >
        <div class="container-fluid"  ng-controller="PanelController">
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
                                <li ui-sref-active="active"><a ui-sref="posts" >Posts</a></li>
                                <li ui-sref-active="active"><a ui-sref="opinions">Opinions</a></li>                                     
                            </ul>            
                            <div class="pull-right">
                                <ul class="navbar-text navbar-right pull-right" ng-show="user.isLoggedIn" >
                                    <p ui-sref-active="active">
                                        Logged in as <cite><a class="navbar-link">{{user.username}}</a></cite>
                                        <a><button ng-click="logout()">Logout</button></a>
                                    </p>   
                                    
                                </ul>                                
                                <ul class=" nav navbar-nav" ng-hide="user.isLoggedIn">
                                    <li ui-sref-active="active"><a ui-sref="login">Login</a></li> 
                                </ul>
                            </div>
                        </div><!--/.nav-collapse -->
                    </div>
                </nav>
            </header>
            <div class="row-fluid">
                <div class="col-md-12">
                    <div class="row-fluid">
                        <div class='col-md-9'>
                            <div class="row-fluid">
                                <div class="alert" ng-show="flash">
                                    {{flash}}
                                </div>
                            </div>
                            <div class="row-fluid">
                               <div  ui-view>Loading...</div>
                            </div>
                        </div>
                        <aside class="col-md-3 well">
                            <ng-include src="'templates/aside/guest.html'"></ng-include> 
                        </aside>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-md-12">
                    <footer class="panel" style='clear:both; padding-top: -21px;'>
                        <p>C 2014 My Site</p>
                    </footer>   
                </div>
            </div>
        </div><!--col-md-10 -->
    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!--        Placed at the end of the document so the pages load faster  --> 
    
<script src="/js/bootstrap.min.js?<?php echo time(); ?>" type="text/javascript"></script> 
<script src="js/libs/jquery-1.10.2.js"></script>
<script src="js/libs/handlebars-v1.3.0.js"></script>
<script src="js/libs/ember-1.8.1.js"></script>
<script src="js/app.js"></script>   
<script src="/js/app.js?<?php echo time(); ?>" type="text/javascript"></script>    
<script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
 
</body>
</html>
