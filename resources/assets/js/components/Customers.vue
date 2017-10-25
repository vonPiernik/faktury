<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                        	<div class="dash-content-sidebar">
								<ul class="invoices-list" v-if="list[0]">
									<customer-list :list="list"></customer-list>
								</ul>
                                <div v-else-if="loading" class="invoices-list--placeholder">
                                    <div class="spinner">
                                      <div class="bounce1"></div>
                                      <div class="bounce2"></div>
                                      <div class="bounce3"></div>
                                    </div>
                                </div>
                                <div v-else class="invoices-list--placeholder">
                                    Nie dodałeś jeszcze żadnych użytkowników
                                </div>
							</div>
                            <transition name="fade" mode="out-in">
							    <router-view :invoice="invoice"
					    					 v-on:upList="updateInvoicesList()"
                                             v-on:showInv="showInvoice($route.params.invoiceId)"
                                             v-on:deleteInv="deleteInvoice"
							    			 :currentUser="currentUser"
                                             :dimmed="dimmed"
                                             @switchL="switchL"
                                             @setPTitle="setPageTitle">
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
            loading: true,
            page: {
            	title: "Twoi klienci"
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
        setPageTitle(newTitle){
            this.page.title = newTitle
        },
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
                this.loading = false
	        }) 
	        
		}, 1000 ) 
    } 
};


</script>
