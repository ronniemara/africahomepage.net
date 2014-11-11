angular.module('myapp.posts.service',['ui.router'])

.factory('posts',['$http', 'utils', function($http, utils){
	var posts = $http.get('posts').then(function (resp) {
    return resp.data;
  });

var factory = {};
factory.all = function () {
    return posts;
  };
  factory.get = function (id) {
    return posts.then(function(){
      return utils.findById(posts, id);
    })
  };
  return factory;
}]);
