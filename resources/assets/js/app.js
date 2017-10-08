
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

Vue.component('invoice-single',require('./components/InvoiceSingle.vue'));

new Vue({
    el: "#app",
    data: function() {
        return {
            list: [],
            invoice: {
                id: '',
                customer: 'Placeholder dla klienta',
                created_at: '',
                items: {}
            }
        };
    },
    
    created() {
        axios.get(`api/invoices`)
        .then(response => {
             this.list = response.data
        })
    },
    
    methods: { 
        showInvoice(id) {


            axios.get(`api/invoices/` + id).then(response => {
                this.invoice.id = response.data.id
                this.invoice.customer = response.data.customer
                this.invoice.created_at = response.data.created_at
            })
        }
    }
})