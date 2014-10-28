
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
        }
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
    }
});

appControllers.factory("AuthenticationService",
        ['$http', '$location', '$q', "SessionService",
            function ($http, $location, $q, SessionService) {
                var cacheSession = function () {
                    SessionService.set('authenticated', true);
                };
                var uncacheSession = function () {
                    SessionService.unset('authenticated');
                };
                var setUser = function(user){
                      this.user =   user;
                      return this.user;
                    };
                    var unsetUser = function(){
                        this.user =   {};
                        return this.user;
                    };
                return {
                    user: {},
                    login: function (credentials) {
                        var defer = $q.defer();
                        $http.post('/auth/login', credentials)
                                .success(function (response) {
                                   
                                 setUser(response);
                                    isLoggedIn = true;
                                    cacheSession;
                                    $location.path('/#/posts');
                                    defer.resolve();
                                })
                                .error(function () {
                                    defer.reject();
                                });
                        return defer.promise;
                    },
                    logout: function () {
                        var defer = $q.defer();
                        $http.get('/auth/logout').success(function () {
                            unsetUser();
                                isLoggedIn = false;
                            uncacheSession;
                            $location.path('/#/login');
                            defer.resolve();

                        }).error(function (err) {
                            defer.reject();
                        });
                        return defer.promise;

                    },
                    check: function () {

                        var defer = $q.defer();
                        $http.get('auth/check').success(function (res) {
                            cacheSession;
                            defer.resolve(res);

                        }).error(function (err) {
                            
                            SessionService.set('authenticated', false);
                        });
                        return defer.promise;


                    },
                    isLoggedIn: false,
                    getUser: function () {
                        var defer = $q.defer();
                        $http.get('auth/user').success(
                                function (res) {

                                    defer.resolve(res);
                                }).error(function (err) {

                            defer.reject();
                        });

                        return defer.promise;
                    }




                };
            }]);

//         AuthenticationService.isLoggedIn().then(function () {
//                    $scope.isLoggedIn = true;
//                },function () {
//                    $scope.isLoggedIn = false;
//                });
//                AuthenticationService.getUser().then(function (res) {
//                    $scope.user = res;
//                });
//                $scope.logout = function(){
//                   AuthenticationService.logout(); 
//                }

appControllers.controller('LoginController',
        ['$scope', '$location', "AuthenticationService",
            function ($scope, AuthenticationService) {
                $scope.credentials = {"email": "", "password": "", "remember": ""};

                $scope.login = function () {
                    debugger;
                   return AuthenticationService.login($scope.credentials);                      
                   
               };
                $scope.logout = function () {
                    return AuthenticationService.logout();
                };

                //$scope.orderProp = 'age';
                $scope.passwordReset = function ($scope, $http)
                {
                    $http.post('/reset-password');
                };
                // Wrapping the Recaptcha create method in a javascript function 

                $scope.showRecaptcha = function (element) {
                    Recaptcha.create("6LdeD_wSAAAAAJjx8sHv23ULc6nUnz_V5_mJgol3",
                            element, {
                                theme: "red",
                                callback: Recaptcha.focus_response_field});
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
            console.log(results[0].body);
            $scope.lead = results[0];
            $scope.opinions = results.shift();
            
           // $scope.opinionId = $routeParams.opinionId;
        
        // $scope.orderProp = 'age';
    }]);



app.controller('PanelController', 
        ['$scope', 'TabsService',  "AuthenticationService",
            function ($scope, TabsService, AuthenticationService) {
               
                        $scope.isLoggedIn = AuthenticationService.isLoggedIn;
                        $scope.isLoggedIn = AuthenticationService.user;
                        $scope.$watch(function () {
                                    return AuthenticationService.isLoggedIn;
                                    },
                                    function (newVal) {
                                    $scope.isLoggedIn = newVal;
                                    });     
           
           $scope.$watch(function () {
                                    return AuthenticationService.user;
                                    },
                                    function (newVal) {
                                    $scope.user = newVal;
                                    });     
           
//                $scope.tab = TabsService.getTab();
//
//                $scope.selectTab = function(tab){
//                    TabsService.selectTab(tab);
//                };
//
//
//                $scope.isSelected = function(tab){
//                    return TabsService.isSelected(tab);
//                }
            }]);

