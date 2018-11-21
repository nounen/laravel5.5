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
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/admin-lte/dist/css/AdminLTE.min.css',
    'node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
    'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
    'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
    'node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
    'node_modules/wangeditor/release/wangEditor.min.css',
], 'public/css/base.css');

mix.styles([
    'resources/assets/css/common.css',
], 'public/css/custom.css');


// AdminLTE js
mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/admin-lte/dist/js/adminlte.min.js',
    'node_modules/moment/min/moment.min.js', // 必须在 datetimepicker 之前
    'node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    'node_modules/wangeditor/release/wangEditor.min.js',
    'resources/assets/js/cookie.js',
], 'public/js/base.js');

mix.scripts([
    'resources/assets/js/menu_filter.js',
    'resources/assets/js/common.js',
], 'public/js/custom.js');


// AdminLTE fonts
mix.copy([
    'node_modules/admin-lte/bower_components/font-awesome/fonts',
    'node_modules/bootstrap/fonts',
], 'public/fonts');
