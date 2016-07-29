<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Africahomepage</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <style> 
            body { padding-bottom: 70px; }
        </style>

        <script data-main="js/main" src="js/require.js"></script>        
    </head>
    <body>
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
                  </ul>
                  <form class="form-inline pull-xs-right">
                    <input class="form-control" type="text" placeholder="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </div>
            </nav>
            <div class="row">                
               <div class="col-xs-8">
               <!--Body content-->
                    <h1>Latest Music</h1>
                            <div class="card text-xs-center">
                                <ul class="list-group list-group-flash">
                                    <li class="list-group-item">
                                        <div class="card-block">
                                            <h4 class="card-title">P-Square</h4>
                                            <h5 class="card-subtitle text-muted">Personally</h5>                                            
                                        </div><!-- end card-block -->
                                        <img src="/images/p-square.jpg" class="img-fluid" alt="Responsive image">
                                        <div class="card-block">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                        <div id="media-player">
                                            <audio id="demo" src="/music/01-Enter.mp3"></audio>
                                            <div>
                                              <button onclick="document.getElementById('demo').play()">Play the Audio</button>
                                              <button onclick="document.getElementById('demo').pause()">Pause the Audio</button>
                                              <button onclick="document.getElementById('demo').volume+=0.1">Increase Volume</button>
                                              <button onclick="document.getElementById('demo').volume-=0.1">Decrease Volume</button>
                                            </div> 
                                        </div>                                    
                                        <div class="card-footer text-muted">
                                            2 days ago
                                        </div>
                                     </li><!-- end list item  -->
                                 </ul> <!--end ul -->
                            </div><!-- end card -->
               </div><!-- end col-xs-8 -->
               <div class="col-xs-4">
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
                    <div class="card text-xs-center">
                        <div class="card-block">
                                                                       
                        </div><!-- end card-block -->
                    </div><!-- end of card -->
                </div><!-- end of col-xs-4>
            </div><!-- end of row -->
            <div class="row">
            <div class="col-xs-12 footer">
                Footer
            </div>
            </div>
        </div>
    </body>    
</html>


