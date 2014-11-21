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
                        <a href="/" style="text-decoration: none;">
                            <span class="icon-africa"></span>AfricaHomepage
                        </a>
                    </h1>
                </div>
                
            </header>
            <div class="row-fluid">
                <div class="col-md-9"  >
                    <mc-messages></mc-messages>
                    <div data-ui-view >
                        <div class="panel">
                            <div class="modal-header">
                                <h3 class="modal-title">Reset your password to AfricaHomepage.net</h3>
                            </div>
                            <div class="modal-body">
                                
                                <form action="<% action('RemindersController@postReset')%>" method="POST">
                                    
                                   @if (Session::has('error'))
                                   <div class="alert alert-warning alert-dismissible" role="alert">
                                       <button type="button" class="close" data-dismiss="alert">
                                           <span aria-hidden="true">&times;</span>
                                           <span class="sr-only">Close</span>
                                       </button>
                                       <% trans(Session::get('error')) %>
                                   </div>
                                    
				@endif
                                    
                                    <input type="hidden" name="token" value="<% $token%>">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input type="email" name="email" placeholder="Email Address" class="form-control" autocomplete="off" required>
                                                </div></div></div></div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required></div></div></div></div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="off" required></div></div></div></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="submit" value="Reset Password"></div></div></div>
                                </form>
                            </div>

                        </div>
                    </div>
                    
                </div>
                <aside class="col-md-3 well">
                        <h3>Connect with Us</h3>
                        <a href="https://www.googleplus.com/africahomepage">
                            <i class="fa fa-google-plus fa-3x"></i>
                        </a>	
                        <a href="https://www.twitter.com/africahomepage">
                            <i class="fa fa-twitter-square fa-3x"></i>

                        </a>	
                    </aside>
            </div>
                <footer class="panel">
                    <p> <i class="fa fa-copyright"></i>2014 My Site</p>
                </footer>

            </div><!--/.fluid-container-->

            <script src="/js/bootstrap.min.js?<?php echo time(); ?>" type="text/javascript"></script>
    </body>
</html>




