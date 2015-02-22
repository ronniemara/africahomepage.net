(function () {
	var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource']);


	    appControllers.filter('page', function () {
		
    return function (input, start, end) {
        return input.slice(start, end);
    };
});
    appControllers
        .factory('Account', function($http) {
            return {
                getProfile: function() {
                    return $http.get('/api/me');
                },
                updateProfile: function(profileData) {
                    return $http.put('/api/me', profileData);
                }
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
		    '$location', '$anchorScroll', '$auth',
		    function ($scope, posts, $location,
				$anchorScroll) {
				    $scope.isAuthenticated = function() {
            return $auth.isAuthenticated();
        };
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
					.then(function() {
						console.log("Object saved OK");
					}, function() {
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
		['$scope', '$idle',
		function ($scope, $idle) {

				//start watching for idling...
				$idle.watch();
				//event listener for when idle time out occurs


				}]);

    appControllers
        .controller('LoginCtrl', ['$scope', '$alert', '$auth',
			'Account', '$state',
        function($scope, $alert, $auth, Account, $state) {
            $scope.login = function() {
                    $auth.login({ email: $scope.email, password: $scope.password })
                    .then(function() {
                            Account.getProfile()
                                .success(function(data) {
                                    $scope.user = data;
                                })
                                .error(function(error) {
                                    $alert({
                                        content: error.message,
                                        animation: 'fadeZoomFadeDown',
                                        type: 'material',
                                        duration: 3
                                    });
                        });
                    })
                    .catch(function(response) {
                        $alert({
                            content: response.data.message,
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });
            };
            $scope.authenticate = function(provider) {
		    $auth.authenticate(provider)
			    .then(function() {
				    Account.getProfile()
				    .success(function(data) {
					    $scope.user = data;
					    $state.go('base.posts.content');   
				    });

			    });
	    };
        }]);

    appControllers
    .controller('NavbarCtrl', function($scope, $auth, $alert) {
        $scope.isAuthenticated = function() {
            return $auth.isAuthenticated();
        };

            $scope.logout = function(){
                if (!$auth.isAuthenticated()) {
                    return;
                }
                $auth.logout()
                    .then(function() {
                        $alert({
                            content: 'You have been logged out',
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });

            };
    });

    appControllers
        .controller('ProfileCtrl', function($scope, $auth, $alert, Account) {

            /**
             * Get user's profile information.
             */
            $scope.getProfile = function() {
                Account.getProfile()
                    .success(function(data) {
                        $scope.user = data;
                    })
                    .error(function(error) {
                        $alert({
                            content: error.message,
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });
            };


            /**
             * Update user's profile information.
             */
            $scope.updateProfile = function() {
                Account.updateProfile({
                    displayName: $scope.user.displayName,
                    email: $scope.user.email
                }).then(function() {
                    $alert({
                        content: 'Profile has been updated',
                        animation: 'fadeZoomFadeDown',
                        type: 'material',
                        duration: 3
                    });
                });
            };

            /**
             * Link third-party provider.
             */
            $scope.link = function(provider) {
                $auth.link(provider)
                    .then(function() {
                        $alert({
                            content: 'You have successfully linked ' + provider + ' account',
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    })
                    .then(function() {
                        $scope.getProfile();
                    })
                    .catch(function(response) {
                        $alert({
                            content: response.data.message,
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });
            };

            /**
             * Unlink third-party provider.
             */
            $scope.unlink = function(provider) {
                $auth.unlink(provider)
                    .then(function() {
                        $alert({
                            content: 'You have successfully unlinked ' + provider + ' account',
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    })
                    .then(function() {
                        $scope.getProfile();
                    })
                    .catch(function(response) {
                        $alert({
                            content: response.data ? response.data.message : 'Could not unlink ' + provider + ' account',
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });
            };

            $scope.getProfile();

        });
    appControllers.controller('SignupCtrl', function($scope, $alert, $auth) {
        $scope.signup = function() {
            $auth.signup({
                displayName: $scope.displayName,
                email: $scope.email,
                password: $scope.password
            }).catch(function(response) {
                if (typeof response.data.message === 'object') {
                    angular.forEach(response.data.message, function(message) {
                        $alert({
                            content: message[0],
                            animation: 'fadeZoomFadeDown',
                            type: 'material',
                            duration: 3
                        });
                    });
                } else {
                    $alert({
                        content: response.data.message,
                        animation: 'fadeZoomFadeDown',
                        type: 'material',
                        duration: 3
                    });
                }
            });
        };
    });

}());



