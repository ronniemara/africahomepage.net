(function () {
	var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource']);

	appControllers
	.factory("AuthSvc",
		['$http', '$q',
		'messageCenterService', '$rootScope',
		'$state',
		function ($http,$q,
			messageCenterService,$rootScope,
			$state) {
				var user = false;
return {
	login: function (credentials, form) {
		var defer = $q.defer();
		$http.post('/api/auth/login', credentials)
		.success(function (response) {
			form.$setPristine();
			messageCenterService.remove();
			messageCenterService.add('success',
				'You are now logged in!',
				{status: messageCenterService.status.next
				});
			defer.resolve(response);

			})
		.error(function (response) {
			messageCenterService.remove();
			messageCenterService.add('danger',
				response.flash,
				{status: messageCenterService.status.unseen});
			defer.reject();
		});
		return defer.promise;
						},
	logout: function () {
		var defer = $q.defer();
		$http.get('/api/auth/logout').success(function () {
			messageCenterService.remove();
			messageCenterService.add('warning',
				'You are now logged out!',
				{status: messageCenterService.status.next});

			defer.resolve();

		}).error(function (err) {
			defer.reject();
		});

		return defer.promise;
	},
	isLoggedIn: function () {

		var defer = $q.defer();
		$http.get('api/auth/check').success(
				function (res) {
					defer.resolve(res);
				}).error(function (err) {
					
					defer.reject();
				});
		return defer.promise;
	},
	reminder: function (email) {
		var defer = $q.defer();
		$http.post('api/remind/email', email)
			.success(function (message) {
				messageCenterService.remove();
				messageCenterService.add('success',
					'Password reset email sent!',
					{status: messageCenterService.status.next});

				$state.go('posts');
				defer.resolve(message);
			})
		.error(function (response) {
			messageCenterService.remove();
			messageCenterService.add('danger',
				response.flash,
				{status: messageCenterService.status.next});

			defer.reject();
		});
		return defer.promise;

	},
	register: function (data) {
		var defer = $q.defer();
		$http.post('api/users', data)
			.success(function (res) {
				messageCenterService.remove();
				messageCenterService.add('success',
					res.flash,
					{status: messageCenterService.status.next});
				$state.go('login');

				defer.resolve();
			})
		.error(function (err) {
			messageCenterService.remove();
			messageCenterService.add('danger',
				err.flash,
				{status: messageCenterService.status.next});
			defer.reject();
		});
	}
};
		}]);
	    
	    
	    appControllers.filter('page', function () {
		
    return function (input, start, end) {
        return input.slice(start, end);
    };
});
	    
appControllers.factory('PostsSvc', ['Restangular', '$q',
    function(Restangular, $q){
return {
  getPosts:function(){
     var defer = $q.defer();
     Restangular.all('api/posts')
	 .getList()
	 .then(function (posts) {
	     defer.resolve(posts);
     });
     return defer.promise;

			
  }  
};	
}]);

appControllers.controller('PostsCtrl',
		['$scope', 'posts',
		    '$location', '$anchorScroll',
		    function ($scope, posts, $location,
				$anchorScroll) {
				$scope.posts = posts;
				$scope.predicate = 'rank';
				$scope.reverse = false;
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
				
				$location.hash('top');

				// call $anchorScroll()
				$anchorScroll();
					});
			
			//voting up and down
			$scope.voteUp = function (post) {


				var send = Restangular.one('posts', post.id).get();
				send.then(function (res) {
					res.votes = res.votes + 1;
					res.put();
				});
				post.votes += 1;
			};
			$scope.voteDown = function (post) {

				var send = Restangular.one('posts', post.id).get();
				send.then(function (res) {
					res.votes = res.votes - 1;
					res.put();
				});
				post.votes -= 1;
			};
			//show comments by getting comments relationship of post from server
			$scope.comments = {"show": false};
			$scope.show = function (post) {
				Restangular.one('posts', post.id).getList('comments').then(function (res) {
					$scope.comments = angular.extend($scope.comments, res);
					$scope.comments.show = true;
				});
			};
			//show form to create a post
			$scope.trigger = function () {
				$scope.create = {"form": true};
			};
			//post a created post
			$scope.data = {"title": "", "url": "", "tags": ""};

			$scope.post = function (form) {
				allPosts.post($scope.data).then(function(res){
					$scope.data = {"title": "", "url": "", "tags": ""};
					form.$setPristine();
					angular.extend(allPosts, res);
				},function(err){
					messageCenterService.remove();
					messageCenterService.add('danger',
						err.flash,
						{status: messageCenterService.status.next});
				});
			};
			$scope.select = function (item) {

				Restangular.one('posts', item.id).getList('comments').then(function (res) {
					$scope.comments = res;
				});
				$scope.selected = item;

			};
			$scope.isSelected = function (item) {
				return $scope.selected === item;
			};
			$scope.newComment = {"message": ""};
			$scope.comment = function (post) {

				Restangular.one('posts', post.id).post('comments', $scope.newComment)
					.then(function(res) {
						console.log("Object saved OK");
					}, function(err) {
						console.log("There was an error saving");
					}); 
			};
			
			$scope.sort = function(predicate){
						$scope.posts = $filter('orderBy')(posts, predicate, false);
						$state.go('posts.content');
			};

//			$scope.getTags = function(tagId) {
//			Restangular.one('tags', tagId).getList('posts')			
//			
//			};

		}]);




appControllers.controller('PanelCtrl',
		['$scope', 'user', 'AuthSvc', 
		'vcRecaptchaService', '$idle', '$rootScope',
		'$state',
		function ($scope, user, AuthSvc, 
			vcRecaptchaService, $idle, $rootScope, $state) {
				$scope.user = user;
				$scope.$on('loggedIn', function(){
					$scope.user = user;
				});
				//start watching for idling...
				$idle.watch();
				//event listener for when idle time out occurs
				$scope.$on('$idleTimeout', function () {
					// end their session and  logout
					if(typeof(Object.getOwnPropertyNames($rootScope.user)) === 'undefined')
				{
					AuthSvc.logout();
				}

				});
				$scope.logout = function () {
					AuthSvc.logout().then(function(){
						$scope.user = false;
					});
				};
				}]);

appControllers.controller('LoginCtrl', ['$scope','AuthSvc', '$state',
	       	function($scope, AuthSvc, $state){
	$scope.credentials = {"email": "", "password": "", "remember": ""};
	$scope.login = function (form) {
		AuthSvc.login($scope.credentials, form)
	.then(function(res){
		$scope.user = res;
		$scope.$emit('loggedIn');
		$state.go('base.posts.content');
	});
	};



$scope.guest = {"email": "", "firstName": "", "lastName": "", "username": "", "password": "", "password_confirmation": "", "challenge": "", "response": ""};
$scope.register = function () {
	var captcha = vcRecaptchaService.data();
	var data = angular.extend($scope.guest, captcha);
	AuthSvc.register(data);
};
$scope.recover = {"email": ""};
$scope.reminder = function () {
	AuthSvc.reminder($scope.recover);
};


}]);


}());



