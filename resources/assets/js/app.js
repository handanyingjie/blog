
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
// Vue.component('tags', require('./components/tags/index.vue'));
// Vue.component('page', require('./components/pageLink/Index.vue'));
// Vue.component('top-nav', require('./components/nav/Index.vue'));
// Vue.component('breadcrumb-nav', require('./components/breadCrumbNav/Index.vue'));

const routes = [
    { path: '/', component: require('./components/list/index.vue')},
    { path: '/detail/:id', component: require('./components/list/detail.vue') }
];

const router = new VueRouter({
    routes
})

const app = new Vue({
    router
}).$mount('#app');
