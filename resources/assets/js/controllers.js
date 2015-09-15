(function() {
"use strict";

    var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource', 'yaru22.angular-timeago','youtube-embed', 'angular-google-gapi']);


    appControllers.controller('MusicCtrl', ['$window', '$modal', '$scope','GApi', 
		    function($window, $modal, $scope , GApi) {	
	GApi.execute('youtube', 'search.list',{
		q : 'afrobeat',
		part: 'snippet',
		type: 'video',
		key:'AIzaSyD1byX4xggRphU4hFqJ7NyDBI0Q3LY14Ok'
  	    }).then(function(resp) {
             $scope.songs = resp.items;
	});

        $scope.open = function(videoId) {
            var ModalInstance = $modal.open({
                templateUrl : "partials/modals/music.html",
                controller : "MusicModalCtrl",	
		resolve: {
			//return an object containing videoId and index of video in result set
			videoId : function() {
			return videoId;
			}
			
		}
            });
        }
    }]);

    appControllers.controller('MusicModalCtrl', function($modalInstance, $scope, videoId, $document, $window) {
 if(!$window.YT) {

	 var tag = document.createElement('script');

	       tag.src = "https://www.youtube.com/iframe_api";
	             var firstScriptTag = document.getElementsByTagName('script')[0];
		           firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

 }
 $scope.videoId = videoId;
	    $scope.ok = function() {
		    $modalInstance.close();
	    }

	    $scope.cancel = function() {
		    $modalInstance.dismiss();	
	    }
    });

})();



