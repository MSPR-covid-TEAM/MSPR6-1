const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue()  // Assurez-vous que `.vue()` est bien appelé ici
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ])
   .webpackConfig({
       resolve: {
           extensions: ['.js', '.jsx', '.json', '.vue'],  // Vérifiez que .vue est bien dans la liste des extensions
       },
   });
