(function() {
"use strict";

    var appControllers = angular.module('appControllers', ['ui.bootstrap', 'ngResource', 'yaru22.angular-timeago', 'angular-google-gapi']);


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
			return {
				idOfVideo: videoId,
			};	
			}
			
		}
            });
        }
    }]);

    appControllers.controller('MusicModalCtrl', function($modalInstance, $scope, videoId, $document, $window) {

	  //  $scope.index = videoId.indexOfVideo;
	    var player;
	    //j$scope.playerString = "player" + videoId.indexOfVideo;

	    if(!$window.YT) {
		    var tag = $document[0].createElement('script');
		    tag.src = "https://www.youtube.com/iframe_api";

		    var firstScriptTag = $document[0].getElementsByTagName('script')[0];
		    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);




		    $window.onYouTubeIframeAPIReady = function () {
			    player= new YT.Player('player', {
				    height: '390',
				    width: '640',
				    videoId: videoId.idOfVideo,
				    events: {
					    'onReady': onPlayerReady,
					    'onStateChange': onPlayerStateChange
				    }
			    });
		    }

		    function onPlayerReady(event) {
			    event.target.playVideo();
		    }

		    var done = false;
		    function onPlayerStateChange(event) {
			    if (event.data == YT.PlayerState.PLAYING && !done) {
				    setTimeout(stopVideo, 6000);
				    done = true;
			    }
		    }

		    function stopVideo() {
			    player.stopVideo();
		    }
	    } else {

		    player= new YT.Player('player', {
			    height: '390',
			    width: '640',
			    origin: "http://localhost:8000",
			    videoId: videoId.idOfVideo,
			    events: {
				    'onReady': onPlayerReady,
				    'onStateChange': onPlayerStateChange
			    }
		    });

		    function onPlayerReady(event) {
			    event.target.getIFrame().playVideo();
		    }

		    var done = false;
		    function onPlayerStateChange(event) {
			    if (event.data == YT.PlayerState.PLAYING && !done) {
				    setTimeout(stopVideo, 6000);
				    done = true;
			    }
		    }

		    function stopVideo() {
			    player.stopVideo();
		    }
	    }


	    $scope.ok = function() {
		    $modalInstance.close();
	    }

	    $scope.cancel = function() {
		    $modalInstance.dismiss();	
	    }
    });

})();



