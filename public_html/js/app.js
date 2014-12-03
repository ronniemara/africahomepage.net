(function () {
    var app = angular.module('myapp', [
        'yaru22.angular-timeago', 'ui.router',
        'appControllers', 'ui.bootstrap', 'ngIdle', 'ngResource',
        'vcRecaptcha', 'MessageCenterModule', 'restangular',
        'com.htmlxprs.autocomplete.directives'
    ]);
    app.config(['$stateProvider', '$urlRouterProvider',
        '$idleProvider', '$httpProvider',
        function ($stateProvider, $urlRouterProvider,
            $idleProvider, $httpProvider) {
            $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
            //set the idle duration
            $idleProvider.idleDuration(300);
            // For any unmatched url, redirect to /posts
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

    app.run(['$rootScope', 
        '$idle', '$state', '$stateParams',
        function ($rootScope, 
            $idle, $state, $stateParams) {
            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;
            //start watching for idling...
            //$idle.watch();
            
        }]);
}());



















