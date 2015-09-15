(function () {
'use strict'; 
    var app = angular.module('myapp', 
		['ui.router', 'angular-google-gapi','appControllers']);

    app.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

	$urlRouterProvider.otherwise("/");

	$locationProvider.html5Mode(true);
	$stateProvider
		.state("home", {
			url : "/",
			templateUrl: "partials/home.html"
		})
		
		.state("home.music", {
			url : "music",
			templateUrl: "partials/music/index.html",
			controller: "MusicCtrl"
		});
		
		
    });

    app.run(['GApi', 'GAuth', 
		    function(GApi, GAuth) {
			    GApi.load('youtube', 'v3');
GAuth.setScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/youtube.readonly");
		    }]);

})();

