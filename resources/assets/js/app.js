require('./bootstrap');

window.Vue = require('vue');

import Router from 'vue-router';
import moment from 'moment'

Vue.use(Router)


Vue.component('App',require('./components/App.vue'));

Vue.component('ItemList',require('./components/Item/ItemList.vue'));

Vue.component('ItemRow',require('./components/Item/ItemRow.vue'));


const Index = require('./components/Index.vue'); 

const Dash = require('./components/Dash.vue');

const InvoiceNew = require('./components/Invoice/InvoiceNew.vue');

const InvoiceSingle = require('./components/Invoice/InvoiceSingle.vue');
 
const InvoiceEdit = require('./components/Invoice/InvoiceEdit.vue');

const InvoiceTrash = require('./components/Trash.vue');


const router = new Router({
  mode: 'history',
  routes: [
    { 
        path: '/faktury', name: 'invoices',
        component: Index, props: true,
        children: [
            { 
                path: '', component: Dash, name: 'invoices-dash'
            },
            { 
                path: 'nowa', component: InvoiceNew, name: 'invoices-create'
            },
            { 
                path: ':invoiceId', component: InvoiceSingle, props: true,
                name: 'invoices-show'
            },
            { 
                path: ':invoiceId/edytuj', component: InvoiceEdit, props: true,
                name: 'invoices-edit'
            }
        ]
    },
    { 
        path: '/kosz', component: InvoiceTrash, name: 'invoices-trash'
    },
  ]
})
new Vue({
    router,
    el: 'app'
})

Vue.filter('formatDate', function(value) {
  if (value) {
    moment.locale('pl');
    return moment(String(value)).format('DD MMMM YYYY')
  }
})
