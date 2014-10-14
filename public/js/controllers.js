
    var appControllers = angular.module('appControllers', []);

    appControllers.controller('PostsListController', ['$scope', '$http',
        function ($scope, $http) {
           $http.get('posts').success(function (data) {
                $scope.posts = data;
                
            });

           // $scope.orderProp = 'age';
        }]);
    

    appControllers.controller('PostsDetailController', ['$scope', '$routeParams',
        function ($scope, $routeParams) {
            $scope.postId = $routeParams.postId;
        }]);

    


// app.controller('PostsListCtrl', ['$scope', '$http',
//        function ($scope, $http) {
//            $scope.showPost = false;
//            $http.get('posts').success(function (data) {
//                $scope.posts = data;
//
//            });
//            
//            $scope.show = function (postId)
//            {
//               var url = "posts/" + postId;
//               console.log(url);
//               
//               $http.get(url).success(function (data) {
//                $scope.$parent.tab = 3;
//                   $scope.post = data;
//                   $scope.showPost = true;
//                   //console.log(data);
//            });
//               
//            }


            //$scope.orderProp = 'age';
        //}]);
        
//         app.controller('PostsDetailCtrl', ['$scope', '$http',
//        function ($scope, $http) {
//            console.log($scope.postId); 
//            _postId = $scope.postId;
            
            
            //$http.get('postsdata/' . $scope.postId).success(function (data) {
             //   $scope.post = data;

            //});
//        }]);


 app.controller('LoginController',
                    ['$scope', '$http', '$q',
                    function ($scope, $http, $q) {
                        var _login = this;
                        
                        $scope.login = function () {
                        var deferred = $q.defer();
                        var promise = deferred.promise;

                        promise.then(
                                        function(result) {
                                        //set tab =1
                                        
                                        if(result.login[0] === "Login failed.")
                                        {
                                        $scope.NotloggedIn = true;
                                        $scope.reason = result.login[0];
                                        }
                                        else{
                                            $scope.$parent.tab = 1;
                                        }
                                        },
                                        function(reason) {
                                        //display error message
                                        alert(reason)
                                        }
                                    );

                        $http.post(
                                    'login', 
                                    {"email": _login.email, "password": _login.password, "remember": _login.remember}
                                   ).success(
                                                function(response) {
                                                deferred.resolve(response);
                                                }
                                    ).error(
                                                function(errors) {                          
                                                deferred.reject(errors);
                                                }
                                    );
                    }

                                //$scope.orderProp = 'age';
                                $scope.passwordReset = function($scope, $http)
                                {
                                    $http.post('/reset-password');
                                }
        }]);

// app.factory("SessionServiceProvider", ["","$http", "$location", function(){
//            
//    }]);

//app.controller('PanelController',
//                    ['$scope', '$http', '$q',
//                    function ($scope, $http, $q) {
//                     $scope.tab = 1;
//                         $scope.selectTab = function(tabSelected)
//                     {
//                         $scope.tab = tabSelected;
//                     }
//                        
//                        this.isSelected = function(checkTab){
//                            return $scope.tab === checkTab;
//                        }
//                    
//                        
//                      }]);

