<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                        	<div class="dash-content-sidebar">
								<ul class="invoices-list">
									<li v-for="inv in list">
                                        <router-link
                                            v-if="inv.draft" 
                                            :to="{ name: 'faktury/edit', params: { invoiceId: inv.id }}"
                                            tag="a"
                                            :class="[inv.draft ? 'draft' : 'final']">
                                                <strong>{{ inv.customer }} <span v-if="inv.draft">(wersja robocza)</span></strong>
                                                <small> {{ inv.created_at }} ( {{ inv.draft }} )</small>
                                        </router-link>
                                        <router-link
                                            v-else
                                            :to="{ name: 'faktury/show', params: { invoiceId: inv.id }}"
                                            tag="a"
                                            :class="[inv.draft ? 'draft' : 'final']">
                                                <strong>{{ inv.customer }} <span v-if="inv.draft">(wersja robocza)</span></strong>
                                                <small> {{ inv.created_at }} ( {{ inv.draft }} )</small>
                                        </router-link>
                                    </li>
								</ul>
							</div>
							    <router-view :invoice="invoice"
					    					 v-on:upList="updateInvoicesList()"
                                             v-on:showInv="showInvoice($route.params.invoiceId)"
                                             v-on:deleteInv="deleteInvoice"
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
            	if(this.$route.params.invoiceId){
                    this.invoice = _.find(this.list, {'id': this.$route.params.invoiceId, 'draft': 0}); 
                }          
            }
        }
    },

    created() { 
        this.updateInvoicesList()
    },

    methods: {  
        showInvoice(id) { 
            console.log("triggered /api/invoices:invoiceId")

            axios.get(`/api/invoices/` + id).then(response => { 
                this.invoice = response.data
            }) 
        },
        
        deleteInvoice(id) { 
            console.log(id)
            axios.delete(`/api/invoices/` + id).then(response => {
                this.updateInvoicesList()
                this.$router.push('/faktury')
            }) 
        },

        updateInvoicesList: _.throttle( function(){
        	axios.get(`/api/invoices`) 
	        .then(response => { 
                console.log("triggered /api/invoices")
	            this.list = response.data 
                if(this.$route.params.invoiceId){
                    $(".dash-content-sidebar").delay("slow").niceScroll().resize(); 
                } else {
                    this.invoice = _.find(this.list, {'draft': 0});
                    $(".dash-content-sidebar").delay("slow").niceScroll().resize(); 
                }

	        }) 
	        
		}, 1000 ) 
    } 
};


</script>
