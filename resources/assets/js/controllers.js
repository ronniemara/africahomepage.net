'use strict'

(function () {
    var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource', 'yaru22.angular-timeago']);

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
     Restangular.all('api/posts'
        .getList()
        .then(function (posts) {
	     defer.resolve(posts);
     });
     return defer.promise;

			
  }  
};	
}]);
appControllers.controller('ModalCtrl', function ($scope, $modalInstance, $http) {

  $scope.post = function (form) {
      $http.post('/api/posts', $scope.data).success();
    $modalInstance.close();
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

appControllers.controller('PostsCtrl',
		['$scope', //'posts',
	       	'$location',
		  '$anchorScroll', '$modal',
		  function ($scope, posts, $location,
			    $anchorScroll, $modal ) {
				   
//				$scope.posts = posts;
				$scope.posts = [
	{
		"title" : "The world is ending",
		"created_at" : "August 18, 2015",
		"author" :{ "username" : "ronmara"}
	},

	{
		"title" : "The world is ending2",
		"created_at" : "August 18, 2015",
		"author" :{ "username" : "ronmara2"}
	},

	];

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
				
				//$location.hash('top');

				// call $anchorScroll()
//				$anchorScroll();
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
			   var modalInstance = $modal.open({
				  templateUrl: "/templates/posts/create-modal.html",
				  controller: 'ModalCtrl'
				  
			      });
			      
			      modalInstance.result.then(function(data){
				  
			      });
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

appControllers.controller('LoginCtrl',  [
    '$scope',  '$auth','Account','$state',
     function($scope,  $auth, Account, $state) {
        $scope.login = function() {
            $auth.login({ email: $scope.email, password: $scope.password })
            .then(function() {
                    Account.getProfile()
                        .success(function(data) {
                            $scope.user = data;
                        })
                        .error(function(error) {
                         
                            
                });
            })
            .catch(function(response) {
               
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

appControllers.controller('NavbarCtrl',[
    '$scope', '$auth',function($scope, $auth ) {
        $scope.isAuthenticated = function() {
            return $auth.isAuthenticated();
        };

        $scope.logout = function(){
            if (!$auth.isAuthenticated()) {
                return;
            }
            $auth.logout()
                .then(function() {
                   
                });
        };
}]);

appControllers.controller('ProfileCtrl',[
    '$scope', '$auth', 'Account',
    function($scope, $auth, Account) {
        /**
         * Get user's profile information.
         */
        $scope.getProfile = function() {
            Account.getProfile()
                .success(function(data) {
                    $scope.user = data;
                })
                .error(function(error) {
                    
                });
        };


        /**
         * Update user's profile information.
         */
        $scope.updateProfile = function() {
            Account.updateProfile({
                username: $scope.user.username,
                email: $scope.user.email
            }).then(function() {
               
            });
        };

        /**
         * Link third-party provider.
         */
        $scope.link = function(provider) {
            $auth.link(provider)
                .then(function() {
                  
                })
                .then(function() {
                    $scope.getProfile();
                })
                .catch(function(response) {
                    
                });
        };

        /**
         * Unlink third-party provider.
         */
        $scope.unlink = function(provider) {
            $auth.unlink(provider)
                .then(function() {
                   
                })
                .then(function() {
                    $scope.getProfile();
                })
                .catch(function(response) {
                   
                });
        };

        $scope.getProfile();

    }]);

appControllers.controller('SignupCtrl', function($scope, $auth) {
    $scope.signup = function() {
        $auth.signup({
            displayName: $scope.displayName,
            email: $scope.email,
            password: $scope.password
        }).catch(function(response) {
            if (typeof response.data.message === 'object') {
                angular.forEach(response.data.message, function(message) {
                   
                });
            } else {
                
            }
        });
    };
});

appControllers.service('gapiService', function() {

	this.initGapi = function(postInitiation) {

		gapi.client.setApiKey('AIzaSyD1byX4xggRphU4hFqJ7NyDBI0Q3LY14Ok');

		gapi.client.load('youtube', 'v3', postInitiation);

		}

});

appControllers.controller('MusicCtrl', function($window, gapiService, $modal, $scope ) {
	
	
	var postInitiation = function() {		
		
		var request =	gapi.client.youtube.search.list({
			q: 'afrobeat',
			part: 'snippet'
		});

		request.execute(function(response) {
			$scope.songs = response.result.items;
$scope.$apply();
				
		});		

	};


	$window.initGapi = function() {
		gapiService.initGapi(postInitiation);
	};
	
	$scope.open = function(videoId) {
		var ModalInstance = $modal.open({
			templateUrl : "partials/modals/music.html",
			controller : "MusicModalCtrl"	
		});

	}
});
appControllers.controller('MusicModalCtrl', function($modalInstance, $scope) {
	$scope.ok = function() {
		$modalInstance.close();
	}
	$scope.cancel = function() {
		$modalInstance.dismiss();	
	}
});



}());



