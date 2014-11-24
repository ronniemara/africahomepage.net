

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
    

app.run(['$rootScope', '$location', "AuthenticationService",
	 '$idle', '$modal', '$state','$stateParams',
    function ($rootScope, $location, AuthenticationService,
              $idle, $modal,$state, $stateParams) {

       $rootScope.$state = $state;
       $rootScope.$stateParams = $stateParams;

       $idle.watch();
        
        $rootScope.$on('$idleTimeout', function () {
            debugger;
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


















