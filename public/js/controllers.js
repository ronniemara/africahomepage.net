
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

    appControllers.controller('PostsCreateController', ['$scope', '$http',
        function ($scope, $http) {
           $http.post('posts/store').success(function (data) {
                $scope.posts = data;
                
            });

           // $scope.orderProp = 'age';
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
                    ['$scope', '$http', '$q', '$location',
                    function ($scope, $http, $q, $location) {
                        $scope.credentials = {"email": "","password": "", "remember": ""};
                        
                        $scope.login = function () {
                            
                       if(true){
                           $location.path('/#/posts');
                       }
                                   
                    }

                                //$scope.orderProp = 'age';
                                $scope.passwordReset = function($scope, $http)
                                {
                                    $http.post('/reset-password');
                                }
                                // Wrapping the Recaptcha create method in a javascript function 
        
                                $scope.showRecaptcha = function (element) {
                                Recaptcha.create("6LdeD_wSAAAAAJjx8sHv23ULc6nUnz_V5_mJgol3",
                                element, {
                                theme: "red",
                                callback: Recaptcha.focus_response_field});
                                }
        }]);
    
    
    appControllers.controller('OpinionListController', ['$scope', '$http',
        function ($scope, $http) {
           $http.get('opinion').success(function (data) {
                $scope.opinions = data;
                
            });

           // $scope.orderProp = 'age';
        }]);
    

    appControllers.controller('OpinionDetailController', ['$scope', '$routeParams',
        function ($scope, $routeParams) {
            $scope.opinionId = $routeParams.opinionId;
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

