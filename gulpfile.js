var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
	    .scripts(["jquery-1.11.3.js", "angular-1.4.3.js",
			   "ui-router0.2.15.js", 
			   "ui-bootstrap-tpls-0.11.2.js","angular-resource.js",
			   "controllers.js",
			   "app.js"])
	    .version(["css/app.css","js/all.js"])
});
