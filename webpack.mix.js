const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
  .copyDirectory('resources/img', 'public/img')
  .copyDirectory('resources/video', 'public/video')
  .options({
    processCssUrls: false
  })
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/homepage.scss', 'public/css')
  .sass('resources/sass/admin.scss', 'public/css')
  .sass('resources/sass/restaurantCreate.scss', 'public/css')
  .sass('resources/sass/restaurantShow.scss', 'public/css')
  .sass('resources/sass/ristoranteGuestShow.scss', 'public/css')
  .sass('resources/sass/restaurantEdit.scss', 'public/css')
  ;



