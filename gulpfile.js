var elixir = require('laravel-elixir');

var paths = {
    'public': elixir.config.publicPath,
    'bootstrap': './node_modules/bootstrap-sass/assets/',
    'jQuery': './node_modules/jquery/',
    'fontAwesome': './node_modules/font-awesome/',
    'datepicker': './node_modules/bootstrap-datepicker/',
    'bootTable': './node_modules/bootstrap-table/',
    'select2': './node_modules/select2/',
    'wysihtml5': './node_modules/bootstrap3-wysihtml5-bower/'
};

elixir(function (mix) {
    mix.sass('app.sass')
        .sass('pdf.sass')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/fonts')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/build/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.public + '/build/fonts/bootstrap')
        .copy(paths.fontAwesome + 'fonts/**', paths.public + '/build/fonts')

        // bootstrap-datepicker
        .copy(paths.datepicker + 'dist/css/bootstrap-datepicker3.min.css', paths.public + '/css/')
        .copy(paths.datepicker + 'dist/js/bootstrap-datepicker.min.js', paths.public + '/js/')
        .copy(paths.datepicker + 'dist/locales/bootstrap-datepicker.es.min.js', paths.public + '/js/')

        // wysihtml5 Editor
        .copy(paths.wysihtml5 + 'dist/bootstrap3-wysihtml5.min.css', paths.public + '/css/')
        .copy(paths.wysihtml5 + 'dist/bootstrap3-wysihtml5.all.min.js', paths.public + '/js/')
        .copy(paths.wysihtml5 + 'dist/locales/bootstrap-wysihtml5.es-ES.js', paths.public + '/js/')

        // select2
        .copy(paths.select2 + 'dist/css/select2.min.css', paths.public + '/css/')
        .copy(paths.select2 + 'dist/js/select2.min.js', paths.public + '/js/')
        .copy(paths.select2 + 'dist/js/i18n/es.js', paths.public + '/js/select2-es.js')

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
