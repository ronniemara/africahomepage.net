
var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource']);

appControllers.factory("SessionService", function () {
	return {
		get: function (key) {
			return sessionStorage.getItem(key);
		},
	set: function (key, value) {
		return sessionStorage.setItem(key, value);
	},
	unset: function (key) {
		return sessionStorage.removeItem(key);
	}
	};
});

appControllers
.factory("AuthenticationService",
	['$http', '$location', '$q',
	"SessionService", "FlashService", '$modal', 
	function ($http, $location, $q, SessionService,
		  FlashService, $modal, $scope) {
	var user = {};
	var loginSuccess = function(response){
		FlashService.show(response.flash);  
		};
	return {
	login: function (credentials) {
		var defer = $q.defer();
		$http.post('/auth/login', credentials)
			.success(function (response) {
				$location.path('/#/posts');
				defer.resolve(response);
			})
			.error(function (response) {
				loginSuccess(response);
				defer.reject();
			});
		return defer.promise;
		},

	logout: function () {
		var defer = $q.defer();
		var user = {};
		$http.get('/auth/logout').success(function () {
			$location.path('/#/login');
			defer.resolve();

		}).error(function (err) {
			defer.reject();
		});

		return defer.promise;
	},
	isLoggedIn: function () {
		var defer = $q.defer();
		$http.get('auth/check').success(
				function (res) {
					defer.resolve(res);
				}).error(function (err) {

					defer.reject();
				});

		return defer.promise;
	},
	reminder: function() {
		var defer = $q.defer();


		$http.post('remind/email')
			.success(function (message){
				defer.resolve(message);
			})
		.error(function (response) {
			loginError(response);
			defer.reject();
		});


		return defer.promise;

	},
	reset:  function(){
		 var defer =$q.defer();

		$http.post('remind/password', credentials)
			.success(function(response)
					{
						loginError({"flash": "Reset successful"});
						$defer.resolve();
					}).error(function(response){
						loginError(response);
						$defer.reject(response);
					});
		return defer.promise;
	},
	register: function(data){
	var defer = $q.defer();
	$http.post('users', data)
		.success(function(res){
			$location.path('/login');
			defer.resolve();	
		})
		.error(function(err){
		defer.reject();
		});
	}
	};
}]);

appControllers.factory("FlashService", [
		'$rootScope',
		function($rootScope){
			return {
				show: function(message){
					$rootScope.flash = message;
				},
	clear: function(){
		$rootScope.flash = "";
	}
			};
		}]);

appControllers.controller('PostsController',
		[ '$scope',  'Posts',
		function ($scope, Posts  ) {
			var posts = Posts.query();
			var post = Posts.get(post);

			$scope.posts = posts;
			$scope.itemsPerPage = 6;
			$scope.currentPage = 1;
			$scope.totalItems = $scope.posts.length;

			$scope.pageCount = function () {
				return Math.ceil($scope.posts.length / $scope.itemsPerPage);
			};

			$scope.$watch('currentPage + itemsPerPage',
				function () {
					var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
				end = begin + $scope.itemsPerPage;
			$scope.position = (6 * ($scope.currentPage - 1));
			$scope.filteredPosts = $scope.posts.slice(begin, end);
				});

		}]);




appControllers.controller('PanelController',
		[ '$scope', 'AuthenticationService', '$rootScope', 
                    'vcRecaptchaService',
		function ( $scope, AuthenticationService, $rootScope, vcRecaptchaService) {
			$scope.credentials = {"email":"", "password":"", "remember":""};
			$scope.login = function(){
				AuthenticationService.login($scope.credentials).then(function(user){
					$rootScope.user = user;
					$rootScope.user.isLoggedIn =true;

				});
			};

			$scope.logout = function(){
				AuthenticationService.logout().then(function(){
					$rootScope.user = {};
					$rootScope.user.isLoggedIn =false;
				})	;
			};
			$scope.showRecaptcha = function (element) {
				// Wrapping the Recaptcha create method in a javascript function 
				Recaptcha.create(
						"6LdeD_wSAAAAAJjx8sHv23ULc6nUnz_V5_mJgol3",
						element, 
						{ 
							theme: "red",
					callback: Recaptcha.focus_response_field
						});
			};
                        $scope.showRecaptcha('recaptcha_div');
			$scope.guest = {"email": "", "firstName": "", "lastName": "", "username": "", "password": "", "password_confirmation": "","challenge":"", "response": ""};
			$scope.register = function(){
                                var captcha = vcRecaptchaService.data();
                                var data = angular.extend($scope.guest, captcha);
				AuthenticationService.register(data)
					.then(function(){},function(){});				
			};

}]);

appControllers.controller('RemindCtrl',
		['token', '$modal',
		'$scope', 'FlashService', 'AuthenticationService',
		function (token, $modal, $scope, FlashService,AuthenticationService) {
			AuthenticationService.reset(credentials);

		}]);

