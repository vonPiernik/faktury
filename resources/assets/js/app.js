
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Include Vue components
 */
Vue.component('item-list', require('./components/ItemList.vue'));

Vue.component('item-row',require('./components/ItemRow.vue'));

new Vue({
    el: "#app"
})