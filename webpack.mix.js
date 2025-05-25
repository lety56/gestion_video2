const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue() // nécessaire pour compiler les fichiers .vue
   .postCss('resources/css/app.css', 'public/css', [])
   .sass('resources/sass/app.scss', 'public/css');
