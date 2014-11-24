

var app = angular.module('myapp', [
    'yaru22.angular-timeago', 'ui.router', 
    'appControllers', 'ui.bootstrap', 'ngIdle', 'ngResource', 
        'vcRecaptcha', 'MessageCenterModule', 'restangular'
]);

app.config(['$stateProvider', '$urlRouterProvider','$keepaliveProvider', 
            '$idleProvider','$httpProvider', 
    function ($stateProvider, $urlRouterProvider, $keepaliveProvider,
                $idleProvider, $httpProvider) {
        
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        
        $idleProvider.idleDuration(5);
        
        
        //
        // For any unmatched url, redirect to /state1
        $urlRouterProvider.otherwise("posts");
        
        // Now set up the states
        $stateProvider
                              
                .state('login', {
                    url: "/login",
                    templateUrl: "templates/login/index.html",
                   controller: 'PanelController'
                })
                .state('signup', {
                    url: "/signup",
                    templateUrl: "templates/login/signup.html",
                    controller: 'PanelController'
                })
                .state('reminder', {
                    url: "/reminder",
                    templateUrl: "templates/login/reminder.html",
                    controller: 'PanelController'
                })
                .state('posts', {
                    url: '/posts',
                    templateUrl: 'templates/posts/posts.html',
                    controller: 'PostsController'
            });

                }]);   
    





















