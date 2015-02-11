(function () {
    var app = angular.module('myapp', [
        'yaru22.angular-timeago', 'ui.router',
        'appControllers', 'ui.bootstrap', 'ngIdle', 'ngResource',
        'vcRecaptcha', 'MessageCenterModule', 'restangular',
        'com.htmlxprs.autocomplete.directives',
        'satellizer'
    ]);
    
    app.config(['$stateProvider', '$urlRouterProvider',
        '$idleProvider', '$httpProvider', '$locationProvider',
        '$authProvider',
        function ($stateProvider, $urlRouterProvider,
            $idleProvider, $httpProvider, $locationProvider, $authProvider) {


            $authProvider.google({
                clientId: '748703416673-rs7stfqdso6ahb7s42hiac2rran263sn.apps.googleusercontent.com'
            });



             $locationProvider.html5Mode(true); 
            $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
            //set the idle duration
            $idleProvider.idleDuration(300);
            // For any unmatched url, redirect to /posts
            $urlRouterProvider.otherwise('/posts');
            // Now set up the states
            $stateProvider
                .state('base', {
                    url: "",
                    templateUrl: "/templates/base/index.html"

                })
                .state('base.login', {
                    url: "/login",
                    templateUrl: "/templates/login/index.html",
                    controller: 'LoginCtrl'
                })
                .state('base.signup', {
                    url: "/signup",
                    templateUrl: "/templates/login/signup.html",
                    controller: 'LoginCtrl'
                })
                .state('base.reminder', {
                    url: "/reminder",
                    templateUrl: "/templates/login/reminder.html",
                    controller: 'LoginCtrl'
                })
                .state('base.posts', 
				{   abstract: true,
				    url: '/posts',
				    templateUrl:  '/templates/posts/posts.html'
				    
		})
		.state('base.posts.content',
		    {
			url: '',
			resolve: {	
			    posts: function (PostsSvc) {
						    return PostsSvc.getPosts();
						}
					    },
			views:
			    {
				'create': { templateUrl: '/templates/posts/create.html',
					    controller: 'PostsCtrl'
				},
				'list': {   templateUrl: '/templates/posts/list.html',
					    controller: 'PostsCtrl'
					}
			    }

		    });

	}]);

    app.run(['$rootScope', '$idle', '$state',
	     '$stateParams', '$window', 'AuthSvc',
		    function ($rootScope, $idle, $state,
			      $stateParams
			    ) {
				    $rootScope.$state = $state;
				    $rootScope.$stateParams = $stateParams;
				    //start watching for idling...
				    $idle.watch();

				    // $rootScope.$on('$idleTimeout',
					//     function () {
					//     // end their session and  logout
					// 	     if(typeof(Object.getOwnPropertyNames(AuthSvc.user)) === null)
					// 	     {
					// 	 AuthSvc.logout();
					// 	 }
					//     });
				    $state.transitionTo('base.posts.content');

				    }]);
}());



















