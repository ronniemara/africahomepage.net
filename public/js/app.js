

var app = angular.module('myapp', [
    'yaru22.angular-timeago', 'ui.router', 'appControllers', 'ui.bootstrap', 'ngIdle'

]);

app.config(['$stateProvider', '$urlRouterProvider','$keepaliveProvider', 
            '$idleProvider','$httpProvider',
    function ($stateProvider, $urlRouterProvider, $keepaliveProvider,
                $idleProvider, $httpProvider) {
        
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        
        $idleProvider.idleDuration(60);
        $idleProvider.warningDuration(20);
        $keepaliveProvider.interval(60);
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
                .state('reminder', {
                    url: "/reminder?token",
                    controller: "RemindCtrl",
                    resolve: {
                        token: function($stateParams){
                        return $stateParams.token;
                        }
                    }
                    
                });
                
                
                

    }]);

app.run(['$rootScope', '$location', "AuthenticationService", '$idle', '$modal',
    function ($rootScope, $location, AuthenticationService, $idle, $modal) {
        
        $idle.watch();
        
        AuthenticationService.isLoggedIn().then(function(user){
            $rootScope.user = user;                           
            $rootScope.user.isLoggedIn = true;
        });

        $rootScope.$on('$stateChangeStart', function (event, next, current) {
            var statesThatRequireAuth = ['create'];
            var urlGiven = $location.path();

            if ((statesThatRequireAuth.indexOf(urlGiven) !== -1) && !AuthenticationService.isLoggedIn()) {
                $location.path('/login');
            }
        });

        $rootScope.$on('$idleTimeout', function () {
            // end their session and redirect to login
            AuthenticationService.logout().then(function(){
                    $rootScope.user = null;                           
            $rootScope.user.isLoggedIn = false;
            $rootScope.timedout = $modal.open({
                        templateUrl: 'templates/login/index.html',
                        backdrop: true,
                        windowClass: 'modal',
                        controller: function ($scope, $modalInstance, credentials) {
                            $scope.credentials = credentials;
                            $scope.login = function () {
                                
                                $modalInstance.close($scope.credentials);
                            };
                            $scope.close = function () {
                                $modalInstance.dismiss('cancel');
                            };
                        },
                        resolve: {
                            credentials: function () {
                                return $scope.credentials;
                            }
                        }
                    });
                    $rootScope.timedout.result.then(function (credentials) {
                        $scope.credentials = credentials;
                        AuthenticationService.login($scope.credentials).then(function(user){
                          $rootScope.user = user; 
                          
                          $rootScope.user.isLoggedIn = true;
                        });
                    }, function () {
                    
                    });
                
        });
        });
    }]);


















