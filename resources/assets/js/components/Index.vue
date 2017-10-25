<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                        	<div class="dash-content-sidebar">
								<ul class="invoices-list" v-if="list[0]">
									<li v-for="inv in list">
                                        <router-link
                                            v-if="inv.draft" 
                                            :to="{ name: 'invoices-edit', params: {  invoiceId: inv.id }}"
                                            tag="a"
                                            class="draft">
                                                <strong>{{ inv.customer }} <span>(wersja robocza)</span></strong>
                                                <small> {{ inv.created_at | formatDate }}</small>
                                        </router-link>
                                        <router-link
                                            v-else
                                            :to="{ name: 'invoices-show', params: { invoiceId: inv.id }}"
                                            tag="a"
                                            class="final">
                                                <strong>{{ inv.customer }}</strong>
                                                <small> {{ inv.created_at | formatDate }}</small>
                                        </router-link>
                                    </li>
								</ul>
                                <div v-else class="invoices-list--placeholder">
                                    Nie utworzyłeś jeszcze żadnej faktury
                                </div>
							</div>
                            <transition name="fade" mode="out-in">
							    <router-view :invoice="invoice"
					    					 v-on:upList="updateInvoicesList()"
                                             v-on:showInv="showInvoice($route.params.invoiceId)"
                                             v-on:deleteInv="deleteInvoice"
							    			 :currentUser="currentUser"
                                             :dimmed="dimmed"
                                             @switchL="switchL">
							    </router-view>
                            </transition>
                       
	</div>
</template>


<script>
module.exports = {
     props: ['currentUser', 'dimmed'],
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
        switchL() {
            this.$emit('switchL');
        },
        showInvoice(id) { 
            axios.get(`/api/users/`+ this.currentUser.id + `/invoices/` + id).then(response => { 
                this.invoice = response.data
            }) 
        },
        
        deleteInvoice(id) { 
            console.log(id)
            axios.delete(`/api/users/`+ this.currentUser.id + `/invoices/` + id).then(response => {
                this.updateInvoicesList()
                this.$router.push('/faktury')
            }) 
        },

        updateInvoicesList: _.throttle( function(){
        	axios.get(`/api/users/`+ this.currentUser.id + `/invoices`) 
	        .then(response => { 
	            this.list = response.data 

	        }) 
	        
		}, 1000 ) 
    } 
};


</script>
