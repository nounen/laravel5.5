let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

/**
 // 运行所有 Mix 任务...
 npm run dev

 // 运行所有 Mix 任务并缩小输出..
 npm run production

 npm run watch

 npm run watch-poll
 */
// AdminLTE css
mix.styles([
    'resources/assets/adminlte/css/font-awesome.min.css',
    'resources/assets/adminlte/css/ionicons.min.css',
    'resources/assets/adminlte/css/bootstrap.min.css',
    'resources/assets/adminlte/css/AdminLTE.min.css',
    'resources/assets/adminlte/css/_all-skins.min.css',
], 'public/css/adminlte.css');


// AdminLTE js
mix.scripts([
    'resources/assets/adminlte/js/jquery.min.js',
    'resources/assets/adminlte/js/bootstrap.min.js',
    'resources/assets/adminlte/js/adminlte.min.js',
    'resources/assets/adminlte/js/menu_filter.js',
], 'public/js/adminlte.js');

// AdminLTE fonts
mix.copy('resources/assets/adminlte/fonts', 'public/fonts');
