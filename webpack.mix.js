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

mix.js('resources/js/secrets-app.jsx', 'public/js')
   .postCss('resources/sass/secrets-app.css', 'public/css', [
       require('tailwindcss')
   ])
    .react();
//    .sass('resources/sass/app.scss', 'public/css');
