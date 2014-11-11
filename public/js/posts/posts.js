angular.module('myapp.posts', ['ui.router'])

.config( 	['$stateProvider', '$urlRouterProvider', 
	function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('posts', {
	abstract: true,
	url: '/posts',
	templateUrl: 'templates/posts/posts.html',
	resolve: {
             posts: ['posts',
            function( posts){
            return posts.all();
           }]
         },
	controller: ['$scope', '$state', 'posts', 'utils',
function (  $scope,   $state,   posts,   utils) {

// Add a 'contacts' field in this abstract parent's scope, so that all
// child state views can access it in their scopes. Please note: scope
// inheritance is not due to nesting of states, but rather choosing to
// nest the templates of those states. It's normal scope inheritance.
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


			}]
})
.state('posts.list', {
url: "",
templateUrl: 'templates/posts/index.html'
}

);

}]);
