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

/* //Fournisseurs 
mix.js([
  'resources/js/crm/fournisseurs/helper.js',
  'resources/js/crm/fournisseurs/fournisseurs.js'], 
  'public/js/crm/fournisseurs/fournisseurs.js');

//Contacts  
mix.js(
  'resources/js/crm/fournisseurs/contacts.js', 
  'public/js/crm/fournisseurs/contacts.js')
   */
mix.sass('resources/sass/app.scss', 'public/css');
