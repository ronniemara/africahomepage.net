(function () {
    var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource']);

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

    appControllers
            .factory("AuthenticationService",
                    ['$http', '$location', '$q',
                        'messageCenterService', '$rootScope',
                        function ($http, $location, $q,
                                messageCenterService,$rootScope) {
                                 
                            return {
                                login: function (credentials) {
                                    var defer = $q.defer();
                                    $http.post('/auth/login', credentials)
                                            .success(function (response) {
                                                $rootScope.user = response;
                                                $rootScope.user.isLoggedIn = true;
                                                messageCenterService.remove();
                                                messageCenterService.add('success',
                                                        'You are now logged in!',
                                                        {status: messageCenterService.status.next
                                                        });
                                                $location.path('/#/posts');
                                                defer.resolve(response);
                                            })
                                            .error(function (response) {
                                                messageCenterService.remove();
                                                messageCenterService.add('danger',
                                                response.flash,
                                                {status: messageCenterService.status.unseen});
                                                defer.reject();
                                            });
                                    return defer.promise;
                                },
                                logout: function () {
                                    var defer = $q.defer();
                                        if($rootScope.user.isLoggedIn === false){
                                            return;
                                        }
                                    $http.get('/auth/logout').success(function () {
                                        $rootScope.user = {};
                                        $rootScope.user.isLoggedIn = false;
                                        messageCenterService.remove();
                                        messageCenterService.add('warning',
                                                'You are now logged out!',
                                                {status: messageCenterService.status.next});

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
                                                $rootScope.user = res;
                                                $rootScope.user.isLoggedIn = true;
                                                defer.resolve();
                                            }).error(function (err) {
                                                $rootScope.user = {};
                                                $rootScope.user.isLoggedIn = false;
                                        defer.reject();
                                    });

                                    return defer.promise;
                                },
                                reminder: function (email) {
                                    var defer = $q.defer();
                                    $http.post('remind/email', email)
                                            .success(function (message) {
                                                messageCenterService.remove();
                                                messageCenterService.add('success',
                                                        'Password reset email sent!',
                                                        {status: messageCenterService.status.next});

                                                $location.path('posts');
                                                defer.resolve(message);
                                            })
                                            .error(function (response) {
                                                messageCenterService.remove();
                                                messageCenterService.add('danger',
                                                        response.flash,
                                                        {status: messageCenterService.status.next});

                                                defer.reject();
                                            });
                                    return defer.promise;

                                },
                                register: function (data) {
                                    var defer = $q.defer();
                                    $http.post('users', data)
                                            .success(function (res) {
                                                messageCenterService.remove();
                                                messageCenterService.add('success',
                                                        res.flash,
                                                        {status: messageCenterService.status.next});
                                                $location.path('/login');

                                                defer.resolve();
                                            })
                                            .error(function (err) {
                                                messageCenterService.remove();
                                                messageCenterService.add('danger',
                                                        err.flash,
                                                        {status: messageCenterService.status.next});
                                                defer.reject();
                                            });
                                }
                            };
                        }]);



    appControllers.controller('PostsController',
            ['$scope', 'Restangular',
                function ($scope, Restangular) {
                    // Get all posts from server.
                    var allPosts = Restangular.all('posts');

                    allPosts.getList().then(function (posts) {
                        $scope.posts = posts;
                        $scope.predicate = 'rank';
                        $scope.itemsPerPage = 10;
                        $scope.currentPage = 1;
                        $scope.totalItems = $scope.posts.length;
                        $scope.pageCount = function () {
                            return Math.ceil($scope.totalItems / $scope.itemsPerPage);
                        };
                        $scope.$watch('currentPage + itemsPerPage',
                                function () {
                                    var begin = (($scope.currentPage - 1) * $scope.itemsPerPage),
                                            end = begin + $scope.itemsPerPage;
                                    $scope.position = (10 * ($scope.currentPage - 1));
                                    $scope.filteredPosts = $scope.posts.slice(begin, end);
                                });
                    });
                    //voting up and down
                    $scope.voteUp = function (post) {
                        post.votes += 1;
                        var send = Restangular.one('posts', post.id).get();
                        send.then(function (res) {
                            res.votes = res.votes + 1;
                            res.put();
                        });

                    };
                    $scope.voteDown = function (post) {
                        post.votes -= 1;
                        var send = Restangular.one('posts', post.id).get();
                        send.then(function (res) {
                            res.votes = res.votes - 1;
                            res.put();
                        });
                    };
                    //show comments by getting comments relationship of post from server
                    $scope.comments = {"show": false};
                    $scope.show = function (post) {
                        Restangular.one('posts', post.id).getList('comments').then(function (res) {
                            $scope.comments = angular.extend($scope.comments, res);
                            $scope.comments.show = true;
                        });
                    };
                    //show form to create a post
                    $scope.trigger = function () {
                        $scope.create = {"form": true};
                    };
                    //post a created post
                    $scope.data = {"title": "", "url": "", "tags": ""};

                    $scope.post = function () {
                        allPosts.post($scope.data).then(function(res){
                            $scope.data = {"title": "", "url": "", "tags": ""};
                            $scope.PostForm.$setPristine();
                            angular.extend(allPosts, res);
                        },function(err){
                            messageCenterService.remove();
                            messageCenterService.add('danger',
                                err.flash,
                                {status: messageCenterService.status.next});
                            });
                    };
                    $scope.select = function (item) {

                        Restangular.one('posts', item.id).getList('comments').then(function (res) {
                            $scope.comments = res;
                        });
                        $scope.selected = item;

                    };
                    $scope.isSelected = function (item) {
                        return $scope.selected === item;
                    };
                    $scope.newComment = {"message": ""};
                    $scope.comment = function (post) {
                        
                       Restangular.one('posts', post.id).post('comments', $scope.newComment)
                           .then(function(res) {
                        console.log("Object saved OK");
                        }, function(err) {
                        console.log("There was an error saving");
                        }); 
                    };

                }]);




    appControllers.controller('PanelController',
            ['$scope', 'AuthenticationService', 
                'vcRecaptchaService', '$idle',
                function ($scope, AuthenticationService, 
                 vcRecaptchaService, $idle) {
                     AuthenticationService.isLoggedIn();

                     //start watching for idling...
                        $idle.watch();
                //event listener for when idle time out occurs
                $scope.$on('$idleTimeout', function () {
                // end their session and  logout
                AuthenticationService.logout();
                 
            });
                    $scope.credentials = {"email": "", "password": "", "remember": ""};
                    $scope.login = function () {
                        AuthenticationService.login($scope.credentials);
                        
                    };

                    $scope.logout = function () {
                        AuthenticationService.logout();
                    };

                    $scope.guest = {"email": "", "firstName": "", "lastName": "", "username": "", "password": "", "password_confirmation": "", "challenge": "", "response": ""};
                    $scope.register = function () {
                        var captcha = vcRecaptchaService.data();
                        var data = angular.extend($scope.guest, captcha);
                        AuthenticationService.register(data);
                    };
                    $scope.recover = {"email": ""};
                    $scope.reminder = function () {
                        AuthenticationService.reminder($scope.recover);
                    };

                }]);


}());



