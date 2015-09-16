<!DOCTYPE html>
<html lang="en" ng-app="myapp">
    <head>
        <meta charset="utf-8">
        <title>AfricaHomepage.net</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="africa news">
        <meta name="keywords" content="africa, african, afrobeat">
        <meta name="author" content="">

       <link rel="stylesheet" href="{{ elixir("css/app.css") }}">

        
        <base href="/">
    </head>
    <body>
        <div class="container">
            <div ui-view>Loading...</div>
            <footer class="panel">
                <p> <i class="fa fa-copyright"></i> 2014 Black Mirror Media</p>
            </footer>
        </div><!--/.fluid-container-->

        <!-- Le javascript
        ================================================== -->
	<script src="{{ elixir("js/app.js") }}"></script>
     
    </body>
</html>
