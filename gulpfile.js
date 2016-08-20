var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var node = 'node_modules/';

elixir(function(mix) {
    mix.sass('app.scss')
        .browserify('app.js')
        .copy(node + 'font-awesome/fonts', 'public/fonts');
});
