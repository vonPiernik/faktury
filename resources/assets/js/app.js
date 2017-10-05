
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('item-row', require('./components/ItemRow.vue'), {
    props: [ 'row'],
    template: '#item-template',
    data: function () {
        return {

        } 
    },
    methods: {
        remove() {
            this.$emit('remove');
        }
    }
}),

new Vue({
    el: "#app",
    data: {
        rows: []
    },

    methods: {

        addRow(){
            this.rows.push({row: ''}); 
        },

        removeRow(index){
            this.rows.splice(index,1);
        }
    }
})

