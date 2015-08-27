(function () {
'use strict' 
    var app = angular.module('myapp', 
		['ui.router','appControllers']);

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

})();

function init() {
	  window.initGapi();
}
