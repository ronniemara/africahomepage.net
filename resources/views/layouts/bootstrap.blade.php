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
	<link href="{{ elixir("css/app.css") }}" rel="stylesheet" type="text/css">

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
