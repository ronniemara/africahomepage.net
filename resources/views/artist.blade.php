<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mp3AfricaMusic.com</title>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link href="{{ elixir('css/app.css') }}" rel="stylesheet" type="text/css">
  <style>
  body { padding-bottom: 70px; }
  </style>

</head>
<body  style="max-width: 800px;" class="m-x-auto"	data-title="artist">
	
	
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
          <h1 class="text-xs-center"></h1>
        </div>
          <!--Body content-->
        <div class="row artist-page">            
         
                <div class="player-wrapper m-x-auto">
					<h4><?php echo $artist; ?> - <span class="song-name"></span></h4>
                    <img class="cover"  alt="artist image" >
                    <div class="player gradient">
                        <a class="gradient" id="play" href="" title=""><i class="fa fa-play"></i></a>
                        <a class="gradient" id="mute" href="" title=""><i class="fa fa-volume-off"></i></a>
                        <input type="range" id="seek" value="50" min="0" max="100" step="1" >
                        <output for="seek" id="volume">50</output>
                        <a class="gradient" id="close" href="" title=""><i class="fa fa-stop"></i></a>
                    </div><!-- / player -->
                    <div class="playlist list-group"></div>
                </div><!-- player-wrapper -->
          
        </div><!-- end row -->

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

