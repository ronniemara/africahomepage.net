<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mp3AfricaMusic.com</title>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
  <style>
  body { padding-bottom: 70px; }
  </style>

</head>
<body style="max-width: 800px; margin: 0 auto;" data-title="main">    
	<div class="container">
    <nav class="navbar navbar-light bg-faded">
      <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header">
        &#9776;
      </button>
      <div class="collapse navbar-toggleable-xs" id="navbar-header">
        <a class="navbar-brand" href="#">Africahomepage</a>
        <ul class="nav navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Music</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
          </li>
          <li class="nav-item">
            <div id="status"></div>
          </li>
        </ul>
        <form class="form-inline pull-xs-right">
          <input class="form-control" type="text" placeholder="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
     
    <div class="row">
      <h1 class="text-xs-center">Latest Music</h1>
    </div>
      <!--Body content-->
    <div class="row mp3africa-list-group"></div><!-- end row -->
         <footer class="footer">
          <div class="container">
                      <!--Sidebar content-->
                      <div class="card text-xs-center">
                        <div class="card-block">
                          <h6 class="card-title">Connect with us</h4>
                            <a href="http://facebook.com">
                              <i class="fa fa-facebook"></i>
                            </a>
                            <a href="http://facebook.com">
                              <i class="fa fa-google"></i>
                            </a>
                            <a href="http://facebook.com">
                              <i class="fa fa-twitter"></i>
                            </a>
                          </div><!-- end card-block -->
                        </div><!-- end of card -->

          </div>
        </footer>
  </div><!-- end container -->
  <script type="text/javascript" src="{{ elixir('js/main.js') }}"></script>
</body>
</html>
