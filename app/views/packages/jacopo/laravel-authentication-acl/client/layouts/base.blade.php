<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>AfricaHomepage.net</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    {{ HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') }}
    {{ HTML::style('packages/jacopo/laravel-authentication-acl/css/style.css') }}
    <link href="/css/mystyle.css?<?php echo time(); ?>" rel="stylesheet" media="screen">
    {{ HTML::style('packages/jacopo/laravel-authentication-acl/css/baselayout.css') }}
    {{ HTML::style('packages/jacopo/laravel-authentication-acl/css/fonts.css') }}
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') }}
    <link href="/css/icons.css?<?php echo time(); ?>" rel="stylesheet" media="screen">

    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>
    <header><!--HEADER -->
        <div class="container">
            <div class="mylogo">
                @if (Sentry::check())
                <div class="col-md-6 logo">
                    <h1>
                        <a href="/">
                            <span class="icon-africa"></span> AfricaHomepage
                        </a>
                    </h1>
                </div><!-- end main-content-area -->
                <div class="col-md-6 login-link">
                    <div class="signed-in-as">
                        <p class="navbar-text">Signed in as {{ Session::get('currentUserName') }}
                            <a href="/user/logout">Logout</a></p>
                    </div>
                </div><!-- end col-md-3 -->
                @else
                <div class="col-md-9 logo">
                    <h1>
                        <a href="/">
                            <span class="icon-africa"></span> Homepage Africa
                        </a>
                    </h1>
                </div><!-- end main-content-area -->
                <div class="col-md-3 login-link">
                    <h1><a href="/login">Login</a></h1>
                </div><!-- end col-md-3 -->
                @endif
            </div><!-- end of mylogo -->
        </div><!-- container -->
    </header> <!-- end header -->
        <div class="container">
            <div class="main-area">
                <div class="col-md-9 main-content-area">
                    @yield('content')
                    </div>
                <aside class="col-md-3">
                    <div class="acl-sidebar-widget">
                        <h4>Connect with Us</h4>
                        <a href="https://twitter.com/africahomepage" ><span style="color:black;" class="icon-twitter"></span> </a>
                        <a href="https://plus.google.com/+AfricahomepageNet" rel="publisher"><span style="color:black;" class="icon-googleplus"></span></a>
                        <a href="https://facebook.com/africahomepage" ><span style="color:black;" class="icon-facebook"></span> </a>
                    </div>
                </aside><!-- end of aside -->
            </div>

        </div>
    <div class="container">
        <footer>
            <p style="color: white;">&copy; 2013 Black Mirror Media</p>

            @if (isset($check_user))
            @if($check_user->hasPermission(array('_superadmin', '_user-editor','_group-editor', '_permissions-editor','_profile-editor')))
            {{ HTML::link('/admin/login', 'Admin') }}
            @endif
            @endif

        </footer> <!-- end footer div -->
    </div>
    </body>
</html>