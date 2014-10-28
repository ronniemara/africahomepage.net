

var app = angular.module('myapp', [
    'yaru22.angular-timeago', 'ui.router', 'appControllers'

]);

app.config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {

        //
        // For any unmatched url, redirect to /state1
        $urlRouterProvider.otherwise("posts");

        //
        // Now set up the states
        $stateProvider
                .state("posts", {
                    url: "/posts",
                    templateUrl: 'templates/posts/index.html',
                    controller: 'PostsListController',
                    resolve: {
                        posts: function (PostsService) {
                            return PostsService.getAll();
                        }
                    }

                })
                .state('show', {
                    url: "/show",
                    controller: 'PostsListController',
                    templateUrl: "templates/posts/show.html"
                })
                .state('create', {
                    url: '/create',
            templateUrl: "templates/posts/create.html",
                    controller: 'PostsCreateController'
                    
                })
                .state('opinions', {
                    
                    url: '/opinions',
                    controller: "OpinionsController",
                    templateUrl: "templates/opinion/index.html",
                    resolve: {
                        opinions: function (OpinionService) {
                           
                            return OpinionService.getAll();
                        }
                    }
                })
                .state('login', {
                    url: '/login',
                    controller: 'LoginController',
                    templateUrl: "templates/login/index.html"
                })
                .state('reminder', {
                    url: '/reminder',
                    controller: 'LoginController',
                    templateUrl: "templates/login/reminder.html"
                })
                .state('signup', {
                    url: '/signup',
                    controller: 'LoginController',
                    templateUrl: "templates/login/signup.html"
                })





    }]);

app.run(['$rootScope', '$location', "AuthenticationService",
    function ($rootScope, $location, AuthenticationService) {

        $rootScope.$on('$stateChangeStart', function (event, next, current) {
            var routesThatRequireAuth = ['/create-posts'];
            var urlGiven = $location.path();

            if ((routesThatRequireAuth.indexOf(urlGiven) !== -1) && !AuthenticationService.isLoggedIn()) {
                $location.path('/login');
            }
        });

    }]);

app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }]);
















