const mix = require('laravel-mix');

// mix.config.fileLoaderDirs.fonts = 'fonts';

mix.setPublicPath('public');
mix.setResourceRoot('../');

mix.webpackConfig({
    module: {
        rules: [
            {test: /\.coffee$/, loader: 'coffee-loader'}
        ]
    }
})

/*mix.options({
    processCssUrls: false
})*/

// mix.sourceMaps()

mix.js('resources/coffee/app.coffee', 'js/app.js')
    .js('resources/coffee/login.coffee', 'js/login.js')
    .js('resources/coffee/orders/orders.coffee', 'js/controllers/orders.js')
    .less('resources/less/login.less', 'css/login.css')
    .less('resources/less/app.less', 'css/app.css')
    .less('resources/less/print.less', 'css/print.css')


    // themes
    .less('resources/less/themes/cerulean.less', 'css/themes/cerulean.css')
    .less('resources/less/themes/cosmo.less', 'css/themes/cosmo.css')
    .less('resources/less/themes/cyborg.less', 'css/themes/cyborg.css')
    .less('resources/less/themes/darkly.less', 'css/themes/darkly.css')
    .less('resources/less/themes/flatfly.less', 'css/themes/flatfly.css')
    .less('resources/less/themes/yeti.less', 'css/themes/yeti.css')
    .less('resources/less/themes/paper.less', 'css/themes/paper.css')