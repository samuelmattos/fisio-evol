const mix = require('laravel-mix')

const path = require('path')

mix.js('src/App/js/main.js', 'public/js')
    .sass('src/App/sass/app.scss', 'public/css');