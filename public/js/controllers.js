
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
        "SessionService", "FlashService", '$modal', 
        function ($http, $location, $q, SessionService,
        FlashService, $modal, $scope) {
            
            var loginSuccess = function(response){
              FlashService.show(response.flash);  
            };
            return {
                
                login: function () {
                    var defer = $q.defer();
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
                reminder: function() {
                        var defer = $q.defer();
                        
                        
                                    $http.post('remind/email')
                                        .success(function (message){
                                            defer.resolve(message);
                                        })
                                        .error(function (response) {
                                            loginError(response);
                                            defer.reject();
                                        });
                               
                        
                    return defer.promise;
                    
                },
                reset:  function(){
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

appControllers.factory("FlashService", [
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

appControllers.controller('PostsController',
    [ '$scope',  'Post',
        function ($scope, Post  ) {
            var posts = Post.query();
            var post = Post.get(post);
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



appControllers.controller("OpinionsController", ['$scope', "opinions",
    function ($scope, opinions) {
        
            var results = opinions;
            $scope.lead = results[0];
            $scope.opinions = results.shift();
            
           // $scope.opinionId = $routeParams.opinionId;
        
        // $scope.orderProp = 'age';
    }]);

appControllers.controller('PanelController',
    [ '$scope', 'TabsService', 
        function ( $scope, TabsService  ) {

                $scope.showRecaptcha = function (element) {
                    // Wrapping the Recaptcha create method in a javascript function 
                            Recaptcha.create(
                                "6LdeD_wSAAAAAJjx8sHv23ULc6nUnz_V5_mJgol3",
                                element, 
                                { 
                                    theme: "red",
                                    callback: Recaptcha.focus_response_field
                                });
                        };

            }]);

appControllers.controller('RemindCtrl',
        ['token', '$modal',
            '$scope', 'FlashService', 'AuthenticationService',
            function (token, $modal, $scope, FlashService,AuthenticationService) {
                AuthenticationService.reset(credentials);
               
            }]);

