<template>
    <div class="panel panel-default panel-default-trash"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
						<div class="dash-content-main dash-content-trash">
                            <div class="panel-body panel-body-trash">
								<table class="invoices-list table table-striped" v-if="list[0]">
                                    <thead>
                                        <tr>
                                            <td>Nazwa klienta</td>
                                            <td>Data utworzenia</td>
                                            <td>Wartość netto</td>
                                            <td>Wartość brutto</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </thead>
                                    <tbody>
									<tr v-for="inv in list" class="singleTrashItem">
                                                <td>{{ inv.customer }} <span v-if="inv.draft">(wersja robocza)</span></td>
                                                <td>{{ inv.created_at | formatDate }}</td>
                                                <td>245,62zł</td>
                                                <td>312,24zł</td>
                                                <td>
                                                    <button 	
                                                		id="restoreInvoice"
                                                		@click="restoreInvoice(inv.id)">
                                                		Przywróć</button>
                                                </td>
                                    </tr>
                                    </tbody>
								</table>

                                <p v-else class="text-center">
                                    Nie usunąłeś jeszcze żadnej faktury :)
                                </p>
                            </div>
	</div>
                       
	</div>
</template>


<script>
module.exports = {
     props: ['currentUser'],
     data: function() { 
        return { 
            list: [],
            page: {
            	title: "Usunięte faktury"
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
		    	this.updateInvoicesList();
            }
        }
    },

    created() { 
    	this.updateInvoicesList();
    },

    methods: {  
        restoreInvoice(id) { 
            axios.put(`/api/users/`+ this.currentUser.id + `/invoices/` + id + `/restore`).then(response => { 
                this.$router.push('/faktury/' + id)
            }) 
        },
        
        updateInvoicesList: _.throttle( function(){
        	axios.get(`/api/users/`+ this.currentUser.id + `/invoices/deleted`) 
	        .then(response => { 
	            this.list = response.data 
	        }) 
	        
		}, 1000 ) 
    } 
};


</script>
