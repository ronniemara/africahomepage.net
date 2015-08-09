(function() {
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
		.state("home.posts", {
			url : "posts",
			templateUrl: "partials/home.posts.html"
		})
		.state("home.music", {
			url : "music",
			templateUrl: "partials/home.music.html"
		})
		.state("home.movies", {
			url : "movies",
			templateUrl: "partials/home.movies.html"
		})
		.state("home.sports", {
			url : "sports",
			templateUrl: "partials/home.sports.html"
		});
});



})();
