<!DOCTYPE html>

<head>
    <title>Nkrumah&#39;s Vision</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="/css/mystyle.css" rel="stylesheet" media="screen">
	<link href="/css/youtubecarousel.css" rel="stylesheet" media="screen">

</head>
<body>
    <!--HEADER -->

    <header>

            <div class="container">

                <div class="logo">
                    <div class="row">

                        <div class="span6">	
                            <a class="brand" href="#"><h1><img src="{{ asset('img/nkrumah.png') }}"alt="logo">Nkrumah&#39;s Vision</h1></a>		
                        </div>					

                        <div class="span6 hidden-phone">
                            <figure class="brand top-ad-box"><img src="http://lorempixel.com/400/90"></figure>
                        </div>

                    </div> <!-- end of row -->

                </div> <!-- end of logo container -->

                <div class="navbar">
                    <div class="navbar-inner">
                <div class="nav-collapse collapse" >


                    <ul class="nav navbox"">
                        <li class="active"><a href="/">Home</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/economy">Economy</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/elections">Elections</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/sports">Sports</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/AU">African Union Events</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/arts">Arts</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/science">Science and Technology</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/history">History</a></li>
                        

                    </ul>

                    
                </div><!-- end of nav-collapse collapse-->
                
                    </div>

            </div> <!-- end navbar inner container -->
            </div>

    </header> <!-- end header -->



    <!-- MAIN BODY -->


    <div class="container main-area">

        
        <div class="row">
            <div class="span2 side-column">
                <div class="column">
                    <h2>Column</h2>
                    <h4>Africa Rising?</h4>
                </div>
                <div class="most-read">
                    Most read
                </div>
            </div><!-- end side-column -->

            <div class="span7 main-content-area">
                
                    @yield('content')
                
            </div><!-- end main-content-area -->

            <aside class="span3 sidebar">
                

                <div class="sidebar-widget">
                    
                    <form class="form-search">
                        <h4>Search</h4>
                        <input type="text" class="input-medium search-query">

                    </form>
                    

                </div>

                

                <div class="sidebar-widget">
                    <h4>Connect with Us</h4>

                    <a href="https://twitter.com/nkrumahsvision" ><i style="color:black;" class="icon-twitter icon-2x"></i> </a>
                    <a href="https://plus.google.com/nkrumahsvision" ><i style="color:black;" class="icon-google-plus icon-2x"></i> </a>
                    <a href="https://facebook.com/nkrumahsvision" ><i style="color:black;" class="icon-facebook icon-2x"></i> </a>

                </div>

                <div class="sidebar-widget clearfix">
                    Ad box X 2
                    <ul class="ad-box-sidebar">
                        <li class='small-ad'><a><img class="img" src="http://lorempixel.com/60/60" class="img-rounded"></a></li>
                        <li class='small-ad'><a><img class="img" src="http://lorempixel.com/60/60" class="img-rounded"></a></li>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    
                    <figure><img src="http://lorempixel.com/140/140" class="img-rounded"></figure>
                </div>
                    
                

            </aside><!-- end of aside -->
            
            

            </div><!-- row -->
            <div id="yt_container" class="videos"></div><!-- end of yt-container -->
    </div><!-- main area -->
    
                
            <footer>
                <div class="container">
                <p style="color: white;">&copy; 2013 Black Mirror Media</p>
                </div>
            </footer> <!-- end footer div -->
    
    

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.youtubecarousel.js"></script>
</body>
</html>
