require('./bootstrap');

window.Vue = require('vue');

import Router from 'vue-router';

Vue.use(Router)


Vue.component('App',require('./components/App.vue'));

Vue.component('ItemList',require('./components/ItemList.vue'));
Vue.component('ItemRow',require('./components/ItemRow.vue'));


const IndexView = require('./components/IndexView.vue');

const InvoiceNew = require('./components/InvoiceNew.vue');

const InvoiceSingle = require('./components/InvoiceSingle.vue');

const InvoiceEdit = require('./components/InvoiceEdit.vue');


const router = new Router({
  mode: 'history',
  routes: [
    { 
        path: '/faktury', name: 'faktury',
        component: IndexView, props: true,
        children: [
            { 
                path: '', component: InvoiceSingle
            },
            { 
                path: 'nowa', component: InvoiceNew, name: 'faktury/create'
            },
            { 
                path: ':invoiceId', component: InvoiceSingle, props: true,
                name: 'faktury/show'
            },
            { 
                path: ':invoiceId/edytuj', component: InvoiceEdit, props: true,
                name: 'faktury/edit'
            }
        ]
    }
  ]
})

new Vue({
    router,
    el: 'app'
})

