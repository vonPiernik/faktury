require('./bootstrap');

window.Vue = require('vue');

import Router from 'vue-router';
import moment from 'moment'

import { directive as onClickOutside } from 'vue-on-click-outside' 
Vue.directive('on-click-outside', onClickOutside)

Vue.use(Router)


Vue.component('App',require('./components/App.vue'));

Vue.component('ItemList',require('./components/Item/ItemList.vue'));

Vue.component('ItemRow',require('./components/Item/ItemRow.vue'));

Vue.component('InvoiceList',require('./components/Invoice/InvoiceList.vue'));


Vue.component('ProductList',require('./components/Product/ProductList.vue'));


Vue.component('CustomerList',require('./components/Customer/CustomerList.vue'));


const Invoices = require('./components/Invoices.vue'); 

const Trash = require('./components/Trash.vue');

const Products = require('./components/Products.vue');

const Customers = require('./components/Customers.vue');



const ProductNew = require('./components/Product/ProductNew.vue');

const ProductEdit = require('./components/Product/ProductEdit.vue');

const ProductSingle = require('./components/Product/ProductSingle.vue');



const CustomerNew = require('./components/Customer/CustomerNew.vue');

const CustomerEdit = require('./components/Customer/CustomerEdit.vue');

const CustomerSingle = require('./components/Customer/CustomerSingle.vue');



const Main = require('./components/Invoice/Main.vue');

const InvoiceNew = require('./components/Invoice/InvoiceNew.vue');

const InvoiceSingle = require('./components/Invoice/InvoiceSingle.vue');
 
const InvoiceEdit = require('./components/Invoice/InvoiceEdit.vue');


const router = new Router({
  mode: 'history',
  routes: [
    { 
        path: '/faktury', name: 'invoices',
        component: Invoices, props: true,
        children: [
            { 
                path: '', component: Main, name: 'invoices-dash'
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
        path: '/kosz', component: Trash, name: 'invoices-trash'
    },
    { 
        path: '/produkty', component: Products, name: 'products',
        children: [
            { 
                path: 'nowy', component: ProductNew, name: 'products-create'
            },
            { 
                path: ':productId', component: ProductSingle, props: true,
                name: 'products-show'
            },
            { 
                path: ':productId/edytuj', component: ProductEdit, props: true,
                name: 'products-edit'
            }
        ]
    },
    { 
        path: '/klienci', component: Customers, name: 'customers',
        children: [
            { 
                path: 'nowy', component: CustomerNew, name: 'customers-create'
            },
            { 
                path: ':customerId', component: CustomerSingle, props: true,
                name: 'customers-show'
            },
            { 
                path: ':customerId/edytuj', component: CustomerEdit, props: true,
                name: 'customers-edit'
            }
        ]
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
