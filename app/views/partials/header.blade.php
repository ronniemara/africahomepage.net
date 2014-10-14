
<div class="col-md-offset-5  col-sm-offset-3">
    <h1><a href="/opinion" style="text-decoration: none;"><span class="icon-africa"></span>AfricaHomepage</a></h1>
</div> 

<div class="col-md-offset-2 col-md-8">
    <nav class="navbar navbar-default " role="navigation">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    @if (Sentry::check())
                    <p class="navbar-text navbar-right">
                        Logged in as <a href="#" class="navbar-link">Username</a>
                    </p>
                    @else
                    <p class="navbar-text navbar-right">
                        <a href="/login" class="navbar-link">Login</a>
                    </p>
                    @endif 
                    <ul class="nav navbar-nav" ng-init="tab=1">
                        <li ng-class="{ active:tab === 1 }"><a href="/opinion" ng-click="tab = 1">Opinion</a></li>  
                        <li ng-class="{ active:tab === 2 }"><a href="/posts" ng-click="tab = 2">Posts</a></li>
                    </ul>             
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </nav>
</div>
