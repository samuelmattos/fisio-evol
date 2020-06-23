const mix = require('laravel-mix')

const path = require('path')

mix.js('src/App/js/main.js', 'public/js')    
    .js('src/App/js/function.js', 'public/js')
    .js('src/App/js/evolucao.js', 'public/js')
    .js('src/App/js/home.js', 'public/js')
    .js('src/App/js/inscrever.js', 'public/js')
    .js('src/App/js/user.js', 'public/js')
    .sass('src/App/sass/app.scss', 'public/css').sourceMaps();