window.Vue = require('vue');
window.axios = require('axios')
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import articleIndex from './components/article/index.vue';
import articleCreate from './components/article/create';
import articleEdit from './components/article/update';

const routes = [
    {
        path: '/',
        components: {
            articleIndex: articleIndex
        }
    },
    {path: '/article/create', component: articleCreate, name: 'articleCreate'},
    {path: '/article/edit/:id', component: articleEdit, name: 'articleEdit'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')