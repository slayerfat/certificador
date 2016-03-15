var elixir = require('laravel-elixir');

var paths = {
    'public': elixir.config.publicPath,
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'jQuery': './node_modules/jquery/',
    'fontAwesome': './node_modules/font-awesome/',
    'bootTable': './node_modules/bootstrap-table/'
};

elixir(function (mix) {
    mix.sass('app.sass')
        .sass('pdf.sass')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/build/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/build/fonts/bootstrap')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts')

        // bootstrap-table
        .copy(paths.bootTable + 'src/bootstrap-table.css', paths.public + '/css/')
        .copy(paths.bootTable + 'src/bootstrap-table.js', paths.public + '/js/')
        .copy(paths.bootTable + 'src/locale/bootstrap-table-es-CR.js', paths.public + '/js/')
        .copy('./resources/assets/js/bootstrap-table/initBootstrapTable.js', paths.public + '/js/')
        .scripts([
            paths.jQuery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js"
        ])
        .version([
            'css/app.css',
            'css/pdf.css',
            'js/all.js'
        ])
        .browserSync({
            proxy: 'jornadas.app'
        });
});
