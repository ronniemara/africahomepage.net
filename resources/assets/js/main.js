window.Tether = {};
require('./jquery.js');
require('bootstrap');

var fs = require('fs');
var domify = require('domify');
var cfsign = require('aws-cloudfront-sign');
var AWS = require('aws-sdk');
var apigClientFactory = require('aws-api-gateway-client');


// Initialize the Amazon Cognito credentials provider
AWS.config.region = 'us-east-1'; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
	IdentityPoolId: 'us-east-1:6d54f99d-7587-40d5-8a15-1fb02a6fafaa',
});


function addEvent(elem, link) {
	elem.click(function() {
		window.location.href = link;
	});
}

var signingParams = {
	keypairId: 'APKAJGMF5S4BA6LURESA',

	// Optional - this can be used as an alternative to privateKeyString
	privateKeyString: '-----BEGIN RSA PRIVATE KEY-----\n' +
		'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\n'     +
		'-----END RSA PRIVATE KEY-----',
	expireTime: Date.now() + 6000000
}
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

	var apigClient = apigClientFactory.newClient(AWS.config.apigateway);

	var params = {};
	var pathTemplate = '/tracks';
	var method = 'GET';
	var body = {};
	var additionalParams = {headers:{},queryParams:{}};

	apigClient.invokeApi(params, pathTemplate, method, additionalParams, body)
		.then(function(result){

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			let stringify = JSON.stringify(result.data.tracks);

			if(window.location.pathname == "/") {            
				//save data in server
				$.ajax({
					url : "session",
					type: 'POST',
					data: {
						data : stringify 
					},
					succes:function(msg) {
						alert('sent data');
					}
				});
			}

			var html = fs.readFileSync(__dirname + '/artist.html', 'utf8');

			var artists_ = new Set();

			for(var i = 0; i <= result.data.tracks.length-1; i++) {
				var mp3Item = result.data.tracks[i];
				artists_.add(mp3Item.Artist);
			}

			for (let artist of artists_) {
				var dom = domify(html);

				dom.querySelector(".artist-name").textContent = artist;

				var lower = artist.toLowerCase();
				var noSpace = lower.replace(" ", "-");
				var origUrl = "https://doyvfpldm7c3l.cloudfront.net/Thumbnails/" +noSpace  + ".png";

				// Generating a signed URL
				var signedUrl = cfsign.getSignedUrl( origUrl, signingParams);

				dom.querySelector(".potrait").src = signedUrl;


				$(".mp3africa-list-group").append(dom);

				let link = '/artist/' + noSpace + '?url=' + signedUrl;

				let current = $('.artist-card:last');
				addEvent(current, link);
			}


			$('.service-container').each(function(){
				var service = $(this);
				var serviceData = service.data('service');
				var myAudioUrl = 'https://doyvfpldm7c3l.cloudfront.net/Music/' + serviceData[0].SongUrl;                     var signedMyAudio = cfsign.getSignedUrl(myAudioUrl, signingParams);
				var myaudio = new Audio(signedMyAudio);
				var container = $('.player-wrapper');
				cover = $('.cover');
				play = $('#play');
				pause = $('#pause');
				mute = $('#mute');
				muted = $('#muted');
				close = $('#close');
				duration = myaudio.duration;

				play.click(function(e) {
					e.preventDefault();
					myaudio.play();

					$(this).replaceWith('<a class="gradient" id="pause" href="" title=""><i class="fa fa-pause"></i></a>');
					container.addClass('containerLarge');
					cover.addClass('coverLarge');
					$('#close').fadeIn(300);
					$('#seek').attr('max',song.duration);
				});
			});

		});

}).catch( function(result){
	//This is where you would put an error callback
	console.log(result.stack);
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

function uniq(a) {
	return Array.from(new Set(a));
}






