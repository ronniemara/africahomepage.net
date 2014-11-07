
var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource']);

appControllers.factory("TabsService", function () {
    var tab = (typeof tab === 'undefined') ? 1 : tab;
    return {
        selectTab: function (tabSelected)
        {
            if (typeof tabSelected === 'undefined') {
                return tab;
            } else {
                tab = tabSelected;
            }

        },
        isSelected: function (checkTab) {
            return tab === checkTab;
        },
        getTab: function () {
            return  tab;
        }
    };
});

appControllers.factory("PostsService", ['$http', '$q', function ($http, $q) {
        return {
            getAll: function () {
                var defer = $q.defer();
                $http.get('/posts').success(function (response) {
                    defer.resolve(response);
                }).error(function (error, status) {
                    defer.reject(error);
                });
                return defer.promise;
            },
            create: function (data) {
                $http.post('posts', data).success(function (data) {
                    $scope.posts = data;
                });
            }
        };
    }]);

appControllers.factory("OpinionService", ['$http', '$q', function ($http, $q) {
        return {
          
            getAll: function () {
                  
                var defer = $q.defer();
                $http.get('/opinions').success(function (response) {
                    defer.resolve(response);
                }).error(function (error, status) {
                    defer.reject(error);
                });
                return defer.promise;
            }

        };
        
    }]);

appControllers.factory("SessionService", function () {
    return {
        get: function (key) {
            return sessionStorage.getItem(key);
        },
        set: function (key, value) {
            return sessionStorage.setItem(key, value);
        },
        unset: function (key) {
            return sessionStorage.removeItem(key);
        }
    };
});

appControllers.factory("AuthenticationService",
    ['$http', '$location', '$q',
        "SessionService", "FlashService", '$modal', '$scope',
        function ($http, $location, $q, SessionService,
        FlashService, $modal, $scope) {
            var loginError = function(response){
              FlashService.show(response.flash);  
            };
            return {
                signup: function ()
                {
                    var defer = $q.defer();
                    var signup = $modal.open({
                        templateUrl: 'templates/login/signup.html'
                    });
                    
                    signup.result.then(function(details){
                        // Wrapping the Recaptcha create method in a javascript function 
                        $scope.showRecaptcha = function (element) {
                            Recaptcha.create(
                                "6LdeD_wSAAAAAJjx8sHv23ULc6nUnz_V5_mJgol3",
                                element, 
                                { 
                                    theme: "red",
                                    callback: Recaptcha.focus_response_field
                                });
                        };
                        $scope.submit = function(details){
                            $http.post('users/create', details)
                                .success()
                                .error();
                        };
                    } );
                },
                login: function (credentials) {
                    var defer = $q.defer();
                    var login = $modal.open({
                        templateUrl: 'templates/login/index.html',
                        backdrop: true,
                        windowClass: 'modal',
                        controller: function ($scope, $modalInstance, credentials) {
                            $scope.credentials = credentials;
                            $scope.submit = function () {
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
                    login.result.then(function (credentials) 
                    {
                        $scope.credentials = credentials;
                        $http.post('/auth/login', credentials)
                            .success(function (user) {
                                SessionService.set('authenticated', true);
                                SessionService.set('user', response.username);
                                $rootScope.user = user;
                                $rootScope.user.isLoggedIn = true;
                                $location.path('/#/posts');
                                defer.resolve();
                            })
                        .error(function (response) {
                            loginError(response);
                            defer.reject();
                        });
                        
                            
                        });
                    return defer.promise;
                },
                               
                logout: function () {
                    var defer = $q.defer();
                    $http.get('/auth/logout').success(function () {
                       SessionService.unset('user');
                        SessionService.unset('authenticated');
                        $scope.user = {};
                        $scope.user.isLoggedIn = false;
                        $location.path('/#/login');
                        defer.resolve();

                    }).error(function (err) {
                        defer.reject();
                    });
                    
                    return defer.promise;
                },
                isLoggedIn: function () {
                    var defer = $q.defer();
                    $http.get('auth/check').success(
                            function (res) {
                                loginError(res);
                                defer.resolve(res);
                            }).error(function (err) {

                        defer.reject();
                    });

                    return defer.promise;
                },
                reminder: function(email) {
                        var defer = $q.defer();
                        var reminder = $modal.open({
                            templateUrl: 'templates/login/reminder.html'
                        });
                        reminder.result.then(function (email) {
                            $scope.email = email;
                                $scope.submit =function(){
                                    $http.post('remind/email', email)
                                        .success(function (message){
                                            defer.resolve(message);
                                        })
                                        .error(function (response) {
                                            loginError(response);
                                            defer.reject();
                                        });
                                };
                            });
                        
                    return defer.promise;
                    
                },
                reset:  function(credentials){
                    $defer =$q.defer();
                    
                    $http.post('remind/password', credentials)
                            .success(function(response)
                    {
                                loginError({"flash": "Reset successful"});
                                $defer.resolve();
                            }).error(function(response){
                                loginError(response);
                                $defer.reject(response);
                            });
                            return defer.promise;
                }
            };
    }]);

appControllers.factory("FlashService", ['$rootScope',
    function(){
        return {
            show: function(message){
                $rootScope.flash = message;
            },
            clear: function(){
                $rootScope.flash = "";
            }
        };
}]);

appControllers.controller('PostsListController',
    [ '$scope',  'posts',
        function ($scope, posts  ) {
            $scope.posts = posts.data;
            $scope.itemsPerPage = 6;
            $scope.currentPage = 1;
            $scope.totalItems = $scope.posts.length;

            $scope.pageCount = function () {
                return Math.ceil($scope.posts.length / $scope.itemsPerPage);
            };

            $scope.$watch('currentPage + itemsPerPage',
                function () {
                    var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                    end = begin + $scope.itemsPerPage;
                    $scope.position = (6 * ($scope.currentPage - 1));
                    $scope.filteredPosts = $scope.posts.slice(begin, end);
                });

        }]);

appControllers.controller('PostsCreateController',
        ["PostsService", '$scope', '$q', 
            function (PostsService, $scope, $q) {
                $scope.post = {"title": "", "url": ""};
                $scope.create = PostsService.create($scope.post);
            }]);

appControllers.controller("OpinionsController", ['$scope', "opinions",
    function ($scope, opinions) {
        
            var results = opinions;
            $scope.lead = results[0];
            $scope.opinions = results.shift();
            
           // $scope.opinionId = $routeParams.opinionId;
        
        // $scope.orderProp = 'age';
    }]);

appControllers.controller('PanelController',
    [ '$modal', '$rootScope','$scope', 'AuthenticationService',
       'TabsService', 'SessionService',
        function ($modal, $rootScope, $scope,
            AuthenticationService,TabsService, SessionService ) {
                $scope.credentials = {"email": "", "password": "", "remember": ""};
                $scope.reminder = AuthenticationService.reminder($scope.email);
                
                $scope.signup = AuthenticationService.signup();

                $scope.login = AuthenticationService.login($scope.credentials);

                $scope.logout = AuthenticationService.logout();

                };

            }]);

appControllers.controller('RemindCtrl',
        ['token', '$modal',
            '$scope', 'FlashService',
            function (token, $modal, $scope, FlashService) {
                AuthenticationService.reset(credentials);
               
            }]);

