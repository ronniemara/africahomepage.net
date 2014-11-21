angular.module('myapp.posts', ['ui.router'])

.config( 	['$stateProvider', '$urlRouterProvider', 
	function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('posts', {
	url: '/posts',
	templateUrl: 'templates/posts/posts.html',
	resolve: {
             posts: ['posts',
            function( posts){
            return posts.all();
           }]
         },
	controller: ['$scope', 'posts', 'postservice',
            function ($scope, posts, postservice ) {

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
                      
                      
                $scope.voteUp = function(postId){
                    postservice.voteUp(postId);
                };
                $scope.voteDown = function(postId){
                    postservice.voteDown(postId);
                };
                $scope.show = function(postId){
                    postservice.show(postId);
                };

            }]
});

}]);
