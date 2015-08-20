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
			templateUrl: "partials/home.posts.html",
			controller: "PostsCtrl"
		})
		.state("home.posts.post", {
			url : "posts",
			templateUrl: "partials/home.posts.html"
		})
		.state("home.music", {
			url : "music",
			templateUrl: "partials/home.music.html",
			controller: "MusicCtrl"
		})
		.state("home.movies", {
			url : "movies",
			templateUrl: "partials/home.movies.html"
		})
		.state("home.sports", {
			url : "sports",
			templateUrl: "partials/home.sports.html"
		})
		.state("home.sports.football", {
			url : "sports/football",
			templateUrl: "partials/home.sports.football.html"
		})
		.state("home.sports.cricket", {
			url : "sports/cricket",
			templateUrl: "partials/home.sports.cricket.html"
		})
		.state("home.sports.athletics", {
			url : "sports/athletics",
			templateUrl: "partials/home.sports.athletics.html"
		})
		.state("home.sports.rugby", {
			url : "sports/rugby",
			templateUrl: "partials/home.sports.rugby.html"
		})
		.state("home.sports.bball", {
			url : "sports/bball",
			templateUrl: "partials/home.sports.bball.html"
		});
});



})();
