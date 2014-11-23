
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
	'messageCenterService', 
	function ($http, $location, $q, 
		   messageCenterService) {
	return {
	login: function (credentials) {
		var defer = $q.defer();
		$http.post('/auth/login', credentials)
			.success(function (response) {
				$location.path('/#/posts');
				defer.resolve(response);
			})
			.error(function (response) {
				
				defer.reject();
			});
		return defer.promise;
		},

	logout: function () {
		var defer = $q.defer();
		
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
	reminder: function(email) {
		var defer = $q.defer();
		$http.post('remind/email', email)
                    .success(function (message){
                        messageCenterService.remove();
                        messageCenterService.add('success',
                            'Password reset email sent!',
                            { status: messageCenterService.status.next });
				
                            $location.path('posts');
				defer.resolve(message);
			})
                    .error(function (response) {
			defer.reject();
                    });
		return defer.promise;

	},
	reset:  function(){
		 var defer =$q.defer();

		$http.post('remind/password', credentials)
			.success(function(response)
					{
						
						$defer.resolve();
					}).error(function(response){
						
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

    

appControllers.controller('PostsController',
		['$scope', 'Restangular',
                        function ($scope, Restangular) {
                            var allPosts = Restangular.all('posts');
                            
                            // This will query /accounts and return a promise.
                            allPosts.getList().then(function(posts) {
                            $scope.posts = posts;
                            $scope.predicate = 'rank';
                            $scope.itemsPerPage = 10;
                            $scope.currentPage = 1;
                            $scope.totalItems = $scope.posts.length;
                            $scope.pageCount = function () {
                                return Math.ceil($scope.totalItems / $scope.itemsPerPage);
                            };
                            $scope.$watch('currentPage + itemsPerPage',
                                    function () {
                                        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                                                end = begin + $scope.itemsPerPage;
                                        $scope.position = (10 * ($scope.currentPage - 1));
                                        $scope.filteredPosts = $scope.posts.slice(begin, end);
                                    });
                        });

                            
//                            $scope.posts = Posts.query();
//                            $scope.itemsPerPage = $scope.posts.per_page;
//                            $scope.currentPage = $scope.posts.current_page;
//                            $scope.totalItems = $scope.posts.total;
//
//                            $scope.pageCount = function () {
//                                return Math.ceil($scope.totalItems / $scope.itemsPerPage);
//                            };
//
//                            $scope.$watch('currentPage + itemsPerPage',
//                                    function () {
//                                        var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
//                                                end = begin + $scope.itemsPerPage;
//                                        $scope.position = (6 * ($scope.currentPage - 1));
//                                        $scope.filteredPosts = $scope.posts.slice(begin, end);
//                                    });
//

                            $scope.voteUp = function (post) {
                                post.votes += 1;
                                var send = Restangular.one('posts', post.id).get();
                                send.then(function(res){
                                     res.votes = res.votes + 1;
                                     res.put();
                                });
                                
                            };
                            $scope.voteDown = function (post) {
                                post.votes -= 1;
                                var send = Restangular.one('posts', post.id).get();
                                send.then(function(res){
                                     res.votes = res.votes - 1;
                                     res.put();
                                });
                            };
                            $scope.comments = { "show" : false };
                            $scope.show = function (post) {
                                
                                // Just ONE GET to /accounts/123/buildings
                                Restangular.one('posts', post.id).getList('comments').then(function(res){
                                   $scope.comments = angular.extend($scope.comments, res);
                                   $scope.comments.show = true;
                                });
                            };
                            $scope.trigger = function(){
                                $scope.create = {"form" : true };
                            };

                        }]);




appControllers.controller('PanelController',
		[ '$scope', 'AuthenticationService', '$rootScope', 
                    'vcRecaptchaService', 'messageCenterService',
		function ( $scope, AuthenticationService, $rootScope, vcRecaptchaService, messageCenterService) {
			$scope.credentials = {"email":"", "password":"", "remember":""};
			$scope.login = function(){
				AuthenticationService.login($scope.credentials).then(function(user){
					$rootScope.user = user;
					$rootScope.user.isLoggedIn =true;
                                         messageCenterService.remove();
                                        messageCenterService.add('success',
                                            'You are now logged in!',
                                            { status: messageCenterService.status.next
                                            });

				});
			};

			$scope.logout = function(){
                            
				AuthenticationService.logout().then(function(){
					$rootScope.user = {};
					$rootScope.user.isLoggedIn =false;
                                        messageCenterService.remove();
                                        messageCenterService.add('warning',
                                            'You are now logged out!',
                                            { status: messageCenterService.status.next });
				})	;
			};
			
                        
			$scope.guest = {"email": "", "firstName": "", "lastName": "", "username": "", "password": "", "password_confirmation": "","challenge":"", "response": ""};
			$scope.register = function(){
                                var captcha = vcRecaptchaService.data();
                                var data = angular.extend($scope.guest, captcha);
				AuthenticationService.register(data)
					.then(function(){},function(){});				
			};
                        $scope.recover = {"email":""};
                        $scope.reminder = function(){
                         AuthenticationService.reminder($scope.recover);   
                        };

}]);



