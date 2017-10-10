
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Router from 'vue-router';

Vue.use(Router)

/**
 * Include Vue components
 */
// Vue.component('item-list', require('./components/ItemList.vue'));

// Vue.component('item-row',require('./components/ItemRow.vue'));

// Vue.component('invoice-list',require('./components/InvoiceList.vue'));

// Vue.component('invoice-single',require('./components/InvoiceSingle.vue'));

Vue.component('App',require('./components/App.vue'));

Vue.component('InvoiceList',require('./components/InvoiceList.vue'));


// 0. If using a module system, call Vue.use(VueRouter)

// 1. Define route components.
// These can be imported from other files
// const App = { component: require('./components/App.vue') }

const IndexView = require('./components/IndexView.vue');

const InvoiceNew = require('./components/InvoiceNew.vue');

const Login = require('./components/Login.vue');

const router = new Router({
  mode: 'history',
  routes: [
    { 
        path: '/faktury',
        component: IndexView,
    },
    { 
        path: '/faktury/nowa',
        component: InvoiceNew
    }
  ]
})

new Vue({
    router,
    el: 'app'
})

