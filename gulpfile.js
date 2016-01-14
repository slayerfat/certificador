var elixir = require('laravel-elixir');

var paths = {
    'public': elixir.config.publicPath,
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'jQuery': './node_modules/jquery/',
    'fontAwesome': './node_modules/font-awesome/'
};

elixir(function (mix) {
    mix.sass('app.sass')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/build/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts')
        .scripts([
            paths.jQuery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js"
        ])
        .version(['css/app.css', 'js/all.js'])
        .browserSync({
            proxy: 'jornadas.app'
        });
});
