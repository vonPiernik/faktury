<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                        	<div class="dash-content-sidebar">
								<ul class="invoices-list">
									<li v-for="inv in list">
										<router-link 
											:to="{ name: 'faktury/show', params: { invoiceId: inv.id }}"
											tag="a"
											@click.native="showInvoice(inv.id)">
										<strong>{{ inv.customer }}</strong>
										<small> {{ inv.created_at }}</small>
									</router-link></li>
								</ul>
							</div>
							    <router-view :invoice="invoice"
					    					 :list="list"
					    					 v-on:upList="updateInvoicesList()"
							    			 :currentUser="currentUser">
							    </router-view>
                       
	</div>
</template>


<script>
module.exports = {
     props: ['currentUser'],
     data: function() { 
        return { 
            list: [],
            page: {
            	title: "Twoje faktury"
            },
            invoice: { 
       			blured: "blured",
                id: '', 
                customer: '', 
                created_at: '', 
                items: {} 
            } 
        }; 
    },

    watch: {
        $route:  {
            handler: function(oldValue, newValue) {
            	this.updateInvoicesList()                
            }
        }
    },

    created() { 
        this.updateInvoicesList()
    },

    methods: {  
        showInvoice(id) { 

            axios.get(`/api/invoices/` + id).then(response => { 
                this.invoice = response.data
            }) 
        },

        updateInvoicesList() {
        	console.log("triggered")

        	axios.get(`/api/invoices`) 
	        .then(response => { 
	             this.list = response.data 
	        }) 
	        if(this.$route.params.invoiceId){
	        	axios.get(`/api/invoices/` + this.$route.params.invoiceId).then(response => { 
	                this.invoice = response.data
	            }) 
	        } else {
		        axios.get(`/api/invoices/first`) 
		        .then(response => { 
	                this.invoice = response.data
		        })
	        }
		}
    } 
};


</script>
