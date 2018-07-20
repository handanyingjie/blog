
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const routes = [
    { path: '/', component: require('./components/list/index.vue')},
    { path: '/detail/:id', component: require('./components/list/detail.vue') },
    { path: '/register', component: require('./components/register/Index.vue') },
    { path: '/login', component: require('./components/login/Index.vue') },
    { path: '/auth', component: require('./components/passport/AuthorizedClients.vue') },
    { path: '/clients', component:  require('./components/passport/Clients.vue') },
    { path: '/accessTokens',  component: require('./components/passport/PersonalAccessTokens.vue')}
];

const router = new VueRouter({
    routes
})

const app = new Vue({
    router
}).$mount('#app');
