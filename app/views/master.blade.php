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


                    <ul class="nav navbox pull-right">
		<!-- <li><a href="/arts">Arts</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/science">Science and Technology</a></li>
                        <li class="divider-vertical"></li>
		<li><a href="/history">History</a></li>
	<li class="divider-vertical"></li>	  -->
        


                    
                </div><!-- end of nav-collapse collapse-->
                
                    </div>

            </div> <!-- end navbar inner container -->
            </div>

    </header> <!-- end header -->



    <!-- MAIN BODY -->


    <div class="container main-area">

        
        <div class="row">

            <div class="span9 main-content-area container">
                    @yield('content')
            </div><!-- end main-content-area -->

            <aside class="span3 sidebar">
                


                
                <div class="sidebar-widget">
                    <h4>Connect with Us</h4>

                    <a href="https://twitter.com/nkrumahsvision" ><i style="color:black;" class="icon-twitter icon-2x"></i> </a>
                    <a href="https://plus.google.com/nkrumahsvision" ><i style="color:black;" class="icon-google-plus icon-2x"></i> </a>
                    <a href="https://facebook.com/nkrumahsvision" ><i style="color:black;" class="icon-facebook icon-2x"></i> </a>

                </div>

                <div class="sidebar-widget clearfix">
                    Advertisement

                   
                    <figure><img src="http://lorempixel.com/140/140" class="img-rounded"></figure>
                </div>
                    
                

            </aside><!-- end of aside -->
            
            

            </div><!-- row -->
    </div><!-- main area -->
    
                
            <footer>
                <div class="container">
                <p style="color: white;">&copy; 2013 Black Mirror Media</p>
                </div>
            </footer> <!-- end footer div -->
    
    

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.youtubecarousel.js"></script>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'nkrumahsvision'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
		        var s = document.createElement('script'); s.async = true;
			        s.type = 'text/javascript';
			        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
				        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
				    }());
        </script>
		    

</body>
</html>
