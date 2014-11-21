angular.module('postservice',['ui.router'])

.factory('posts',['$http', 'utils', function($http, utils){
	var posts = $http.get('posts').then(function (resp) {
    return resp.data;
  });
  

var factory = {};
factory.all = function () {
    
    return posts;
  };
 
  return factory;
}]);
