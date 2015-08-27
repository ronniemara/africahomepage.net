(function() {
"use strict";

    var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource', 'yaru22.angular-timeago']);


    appControllers.controller('MusicCtrl', function($window, $modal, $scope ) {	
	
        $scope.list = function() {

            gapi.client.youtube.search.list({
                q: 'afrobeat',
                part: 'snippet'
            }).execute(function(response) {
                $scope.songs = response.result.items;
                $scope.$apply();		 	
            });		

        }

        $window.initGapi = function() {
            $scope.$apply($scope.load_youtube_api);
        }

        $scope.load_youtube_api = function() {
            gapi.client.setApiKey('AIzaSyD1byX4xggRphU4hFqJ7NyDBI0Q3LY14Ok');
            gapi.client.load('youtube', 'v3', function() {
                $scope.is_backend_ready = true;
                $scope.list();
            });
        }
	
        $scope.open = function(videoId) {

            var ModalInstance = $modal.open({
                templateUrl : "partials/modals/music.html",
                controller : "MusicModalCtrl"	
            });

        }
    
    });

    appControllers.controller('MusicModalCtrl', function($modalInstance, $scope) {

        $scope.ok = function() {
            $modalInstance.close();
       }

        $scope.cancel = function() {
           $modalInstance.dismiss();	
       }
    });

})();



