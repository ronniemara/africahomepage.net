window.Tether = {};
var $ = require('./jquery.js');
require('bootstrap');

var fs = require('fs');
var domify = require('domify');
var cfsign = require('aws-cloudfront-sign');
var AWS = require('aws-sdk');
var _ = require('lodash');
var Rx = require('rx');


// Initialize the Amazon Cognito credentials provider
AWS.config.region = 'us-east-1'; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    IdentityPoolId: 'us-east-1:6d54f99d-7587-40d5-8a15-1fb02a6fafaa',
});

// Make the call to obtain credentials
AWS.config.credentials.get(function(){
    // Credentials will be available when this function is called.
    var accessKeyId = AWS.config.credentials.accessKeyId;
    var secretAccessKey = AWS.config.credentials.secretAccessKey;
    var sessionToken = AWS.config.credentials.sessionToken;
    AWS.config.apigateway = {
        invokeUrl:'https://bq76iu94yb.execute-api.us-east-1.amazonaws.com/beta',
        defaultContentType : 'application/json',
        defaultAcceptType : 'application/json',
        apiKey : 'BekLKPTbUC8elIoMZg5CZrqxrCxZJwf9J7kt4qA1',
        accessKey: accessKeyId,
        secretKey: secretAccessKey,
        sessionToken: sessionToken
    };
    var apigClientFactory = require('aws-api-gateway-client');
    var apigClient = apigClientFactory.newClient(AWS.config.apigateway);

    var params = {};
    var pathTemplate = '/tracks';
    var method = 'GET';
    var body = {};
    var additionalParams = {headers:{},queryParams:{}};

    apigClient.invokeApi(params, pathTemplate, method, additionalParams, body)
        .then(function(result){

			if($("body").data("title") == "main") {

				var html = fs.readFileSync(__dirname + '/artist.html', 'utf8');

				var data = result.data.tracks;
				saveData(data);
				var unique = _.uniqBy(data, 'Artist');
                var urls = _.map(unique, _.property('IconUrl'));
                var fullUrls = _.map(urls, function(i) {
                    return "https://doyvfpldm7c3l.cloudfront.net/Thumbnails/" + i;
                });
				    
				//use RxJS to map urls to signed urls
                var workify = require('webworkify');
                var worker = workify(require('./worker.js'));
                // Create observer to handle sending messages
                var observer = Rx.Observer.create(
                    function (data) {
                        worker.postMessage(data);
                    });

                // Create observable to handle the messages
                var observable = Rx.Observable.create(function (obs) {
                    worker.onmessage = function (data) {
                        obs.onNext(data);
                    };

                    worker.onerror = function (err) {
                        obs.onError(err);
                    };

                    return function () {
                        worker.terminate();
                    };
                });

                var subject = Rx.Subject.create(observer, observable);

                var subscription = subject.subscribe(
                    function (x) {
                        console.log('Next:' + x.data);
                        window.$('.artist-card-list').append(
                        '<li class="artist-card-list-item artist-card">\n' +
                            '<div class="artist-card-wrapper">\n' +
                                '<h6 class="artist-name"></h6>\n' +
                                '<a class="thumbnail" href="#">\n' +
                                    '<img class="img-responsive potrait" ' + 'src=' + x.data + 'alt="Responsive image">\n' +
                                '</a>\n' +
                            '</div><!-- end card -->\n' +
                        '</li>'); 

                    },
                    function (err) {
                        console.log(err);
                    },
                    function () {
                        console.log('Completed');
                    });

                subject.onNext(fullUrls);

				// for(let artist of unique) {
				// 	var dom = domify(html);
				// 	dom.querySelector(".artist-name").textContent = artist.Artist;

				// 	var origUrl = "https://doyvfpldm7c3l.cloudfront.net/Thumbnails/" + artist.IconUrl;

				// 	var signedUrl = [];
                    // if (window.Worker) {
                        // var w = worker(require('./worker.js'));
                        // w.addEventListener('message', function (ev) {
                          // signedUrl.push(ev.data);                            
                        // });

                        // w.postMessage(origUrl);
                        // } else {
                            // alert("Please update your browser");
                        // }
                   
				// 	    }
					    
				// 	for(let url of signedUrl) {
				// 	console.log(url);
				// 	 addTo(url);
				// 	}
				   
			}

			if($("body").data("title") == "artist") {
					let tracks = JSON.parse(localStorage.getItem('tracks'));
					let path = window.location.pathname;
					let splitPath = path.split('/');
					let artistUrl = splitPath[2];
					let artist = artistUrl.replace("-", " ");
					let signedImgUrl = null;
					let  signedTrackUrl = null;
					let myAudio = null;

					let artistTracks = tracks.filter(function(item){
						return item.Artist.toUpperCase() == artist.toUpperCase()
						});

					if(artistTracks != null ) {
						  signedImgUrl = createSignedImgUrl(artistTracks[0].IconUrl);
						  signedTrackUrl = createSignedTrackUrl(artistTracks[0].SongUrl);
						  myAudio = new Audio(signedTrackUrl);
						}
						$(".song-name").text(artistTracks[0].SongTitle);
						$(".cover").attr("src", signedImgUrl);
						$.each(artistTracks, function(item) {
							$(".playlist").append($('<li>', {'class': 'list-group-item'})
              .append( $('<a>').addClass('list-group-item list-group-item-action song')
							.attr('href', '#')
							.text(artistTracks[item].SongTitle)));
						});

						$(".song").click({myAudio : myAudio, artistTracks : artistTracks},function (e) {
							e.preventDefault();
							let index = $(this).closest('.playlist').find('.song').index(this);
							let song = e.data.artistTracks[index];
							let signedSongUrl = createSignedTrackUrl(song.SongUrl);
							e.data.myAudio.pause();
							e.data.myAudio.src = signedSongUrl;
							e.data.myAudio.play();
							$(".song-name").text(song.SongTitle);
							$(".active").removeClass("active");
							$(this).addClass('active');
						});


						$(".song:first").addClass('active');

						let play = $("#play"),
							close = $("#close");
              seek = $("#seek");

						play.click(function(e){
							e.preventDefault();
							//check if track is already set and if expired resign track
							parseUri.options.q.name = 'Expires';
							let expires = parseUri(signedTrackUrl).Expires.Expires;
							if(Date.now() >= expires) {
								signedTrackUrl = createSignedTrackUrl(artistTracks[0].SongUrl);
							}

							myAudio.play();
						});

							 $("#toggle-vol").click(function(e){
							e.preventDefault();
							// myAudio.volume = 0;
                            seek.removeClass("hide");

						});

						close.click(function(e){
							e.preventDefault();
							myAudio.pause();
						});

						myAudio.play();
					}

        }).catch( function(error){
            //This is where you would put an error callback
            console.log(error.message + '\n' + error.stack);
        });
});

 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '348768225333299',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }


function addEvent(elem, link) {
	elem.click(function() {
		window.location.href = link;
	});
}

function saveData(data) {
			localStorage.tracks = JSON.stringify(data);
}

function createSignedImgUrl(origUrl) {
	let imgUrl = "https://doyvfpldm7c3l.cloudfront.net/Thumbnails/" + origUrl;
	return createSignedUrl(imgUrl);
}
function createSignedTrackUrl(origUrl) {
	let trackUrl = "https://doyvfpldm7c3l.cloudfront.net/Music/" + origUrl;
	return createSignedUrl(trackUrl);
}

function createSignedUrl(origUrl) {
    if (window.Worker) {
        var w = worker(require('./worker.js'));
        w.addEventListener('message', function (ev) {
          console.log(ev.data);
          return ev.data;
        });

        w.postMessage(origUrl);

    } else {
        alert("Please update your browser");
    }
}

// parseUri 1.2.2
// (c) Steven Levithan <stevenlevithan.com>
// MIT License

function parseUri (str) {
	var	o   = parseUri.options,
		m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
		uri = {},
		i   = 14;

	while (i--) uri[o.key[i]] = m[i] || "";

	uri[o.q.name] = {};
	uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		if ($1) uri[o.q.name][$1] = $2;
	});

	return uri;
};

parseUri.options = {
	strictMode: false,
	key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
	q:   {
		name:   "queryKey",
		parser: /(?:^|&)([^&=]*)=?([^&]*)/g
	},
	parser: {
		strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
		loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
	}
};

function setSong(elem, audioList, audioObject) {
	elem.click(function(e) {
		e.preventDefault();
		let index = $('a').index(this);
		let song = audioList[index];
		let signedSongURl = createSignedTrackUrl(song.SongUrl);
		audioObject.pause();
		audioObject.src = signedSongUrl;
		audioObject.play();
		$(".active").removeClass("active");
		this.addClass('active');
	});
}

function addTo(url) {
dom.querySelector(".potrait").src = signedUrl;

$(".artist-card-list").append(dom);

let noSpace = artist.Artist.toLowerCase().replace(" ", "-");

let link = '/artist/' + noSpace;

let current = $('.artist-card:last');
addEvent(current, link);
}
