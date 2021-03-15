const mix = require('laravel-mix');
require('laravel-mix-alias');

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
    .js('resources/js/vue.js', 'public/js/vue.js')
    .js('resources/coffee/login.coffee', 'public/js/login.js')
    .js('resources/js/purchase.js', 'public/js/controllers/purchase.js')
    .js('resources/coffee/orders/orders.coffee', 'public/js/controllers/orders.js')
    .js('resources/coffee/product/product.coffee', 'public/js/controllers/product.js')
    .js('resources/coffee/task/task.coffee', 'public/js/controllers/task.js')
    .js('resources/coffee/user/user.coffee', 'public/js/controllers/user.js')
    .js('resources/coffee/schedule/schedule.coffee', 'public/js/controllers/schedule.js')
    .js('resources/coffee/report/report.coffee', 'public/js/controllers/report.js')
    .js('resources/coffee/inventory/inventory.coffee', 'public/js/controllers/inventory.js')
    .js('resources/coffee/sms/sms.coffee', 'public/js/controllers/sms.js')
    .js('resources/coffee/libs.coffee', 'public/js/libs.js')
    .js('resources/coffee/pjax.coffee', 'public/js/pjax.js')
    .js('resources/coffee/Reinitiable.coffee', 'public/js/Reinitiable.js')
    .js('resources/scripts/orders.js', 'public/js/orders.js')
    .js('resources/scripts/index.js', 'public/js/index.js')
    .js('resources/scripts/forms.js', 'public/js/forms.js')
    .js('resources/scripts/products.js', 'public/js/products.js')

    .js('resources/js/shop/ajax.js', 'public/js/shop.js')


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

mix.version()