const mix = require('laravel-mix');

mix.options({
    processCssUrls: false
})

mix.webpackConfig({
    module: {
        rules: [
            {test: /\.coffee$/, loader: 'coffee-loader'}
        ]
    }
})
mix
    .js('resources/coffee/app.coffee', 'public/js/app.js')
    .js('resources/coffee/login.coffee', 'public/js/login.js')
    .js('resources/coffee/orders/orders.coffee', 'public/js/controllers/orders.js')
    .js('resources/coffee/product/product.coffee', 'public/js/controllers/product.js')
    .js('resources/coffee/task/task.coffee', 'public/js/controllers/task.js')
    .js('resources/coffee/user/user.coffee', 'public/js/controllers/user.js')


    .less('resources/less/login.less', 'public/css/login.css')
    .less('resources/less/app.less', 'public/css/app.css')
    .less('resources/less/print.less', 'public/css/print.css')


    // themes
    .less('resources/less/themes/cerulean.less', 'public/css/themes/cerulean.css')
    .less('resources/less/themes/cosmo.less', 'public/css/themes/cosmo.css')
    .less('resources/less/themes/cyborg.less', 'public/css/themes/cyborg.css')
    .less('resources/less/themes/darkly.less', 'public/css/themes/darkly.css')
    .less('resources/less/themes/flatfly.less', 'public/css/themes/flatfly.css')
    .less('resources/less/themes/yeti.less', 'public/css/themes/yeti.css')
    .less('resources/less/themes/paper.less', 'public/css/themes/paper.css')