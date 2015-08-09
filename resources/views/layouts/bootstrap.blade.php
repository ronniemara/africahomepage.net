<!DOCTYPE html>
<html lang="en" ng-app="myapp">
    <head>
        <meta charset="utf-8">
        <title>AfricaHomepage.net</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="africa news">
        <meta name="keywords" content="africa, african, afrobeat">
        <meta name="author" content="">

        <!-- Le styles -->
	<link src="{{ elixir("css/app.css") }}" rel="stylesheet" type="text/css">

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
        <base href="/">
    </head>
    <body>
        <div class="container">
<div ui-view></div>
            <footer class="panel">
                <p> <i class="fa fa-copyright"></i> 2014 Black Mirror Media</p>
            </footer>
        </div><!--/.fluid-container-->

        <!-- Le javascript
        ================================================== -->

	<script type="text/javascript"  src="{{ elixir("js/all.js") }}" ></script>
    </body>
</html>
