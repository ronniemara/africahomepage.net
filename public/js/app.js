

    var app = angular.module('myapp', [
        'yaru22.angular-timeago', 'ngRoute', 'appControllers'

    ]);

    app.config(['$routeProvider',
        function ($routeProvider) {
            $routeProvider.
                    when('/posts', {
                        templateUrl: 'templates/posts/index.html',
                        controller: 'PostsListController'

                    }).
                    when('/posts/:postId', {
                        controller: 'PostsDetailController',
                        templateUrl: 'templates/posts/show.html'

                    }).
                            when('/create-posts', {
                        controller: 'PostsCreateController',
                        templateUrl: 'templates/posts/create.html'

                    }).
                            when('/login', {
                        templateUrl: 'templates/login/index.html',
                        controller: 'LoginController'

                    }).
                             when('/signup', {
                        templateUrl: 'templates/login/signup.html',
                        controller: 'LoginController'

                    }).
                             when('/reset-password', {
                        templateUrl: 'templates/login/reminder.html',
                        controller: 'LoginController'

                    }).
                             when('/opinion', {
                        templateUrl: 'templates/opinion/index.html',
                        controller: 'OpinionListController'

                    }).
                            when('/opinion/:postId', {
                        controller: 'OpinionDetailController',
                        templateUrl: 'templates/opinion/show.html'

                    }).
                    otherwise({
                        redirectTo: '/posts'
                    });
        }]);

    app.config(['$httpProvider', function ($httpProvider) {
            $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        }]);
















