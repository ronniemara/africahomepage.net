<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AfricaHomepage.net</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="/css/bootstrap.min.css?{{ time() }}" rel="stylesheet" media="screen">     
        <link href="/css/font-awesome.min.css?{{ time() }}" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-social.css?{{ time() }}" rel="stylesheet" media="screen">

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

    <body>
        @include('partials.header')
        <div class="container-fluid">
            <div class="row-fluid">        
                @yield('content')
            </div><!--/row-->
            <footer class="col-md-offset-5  col-sm-offset-3" style="clear: left;">
                <p>&copy; 2013 Black Mirror Media</p>
            </footer>

        </div><!--/.fluid-container-->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/js/jquery-1.11.0.js?<?php echo time(); ?>" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js?<?php echo time(); ?>" type="text/javascript"></script>


    </body>
</html>
