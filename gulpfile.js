	
var elixir = require('laravel-elixir');

elixir.config.publicDir = "public_html";
elixir.config.cssOutput = "public_html/css";
elixir.config.jsOutput = "public_html/js";


elixir(function(mix) {

	mix.scripts(["jquery/dist/jquery.js", "angular/angular.js", 
"angular-animate/angular-animate.js",
      "angular-bootstrap/ui-bootstrap-tpls.js", "angular-google-gapi/angular-google-gapi.js",
	"angular-ui-router/release/angular-ui-router.js", "angular-youtube-mb/src/angular-youtube-embed.js"
	],  'resources/assets/js/vendor/vendor.js', "vendor/bower_components");

mix.scripts([
	 "vendor/vendor.js",
"controller.js","app.js"], "public_html/js/app.js");

mix.sass("app.scss", "public_html/css/app.css",{ includePaths : ['vendor/bower_components/bootstrap-sass/assets/stylesheets']});

mix .version(["js/app.js", "css/app.css"])

});

