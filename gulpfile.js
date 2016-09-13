var elixir = require('laravel-elixir');

elixir.config.js.browserify.transformers.push({
    name: 'brfs',
    options: {}
});

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
    mix.sass('app.sass')
        .browserify('main.js')
        .version(['css/app.css', 'js/main.js'])
        .browserSync({
            proxy: 'http://192.168.10.10/'
        });
});
