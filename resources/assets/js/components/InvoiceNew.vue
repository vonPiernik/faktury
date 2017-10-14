<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                         
 
                        <div class="dash-content-main"> 
                            <div class="panel-body">    
                                <form method="POST" action="#" @submit.prevent="createInvoice">

                                    <!-- <dane faktury> -->
                                    <div class="col-md-4">Twoje dane</div>
                                    <div class="col-md-4">
                                        <label for="date">Data wystawienia</label><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date">Dane klienta</label><br>
                                        <input type="text" name="customer" id="customer" required value="Klient" v-model="invoice.customer">
                                    </div>

                                    <br><br>
                                    <hr>
                                    <!-- </dane faktury> -->

                                    <!-- <lista elementów na fakturze> -->
                                    <div class="col-md-12">
                                    
                                        <item-list :invoice="invoice"></item-list>

                                    </div>               
                                    <!-- </lista elementów na fakturze> -->

                                    <input type="submit" value="Wyślij">

                                </form>
                            </div> 
          </div>
	</div>
</template>

<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
module.exports = {
    props: ['currentUser','list'],
    data: function () {
	    return {
		  page: {
		  	title: "Nowa faktura"
		  },
          invoice: { 
            user_id: this.currentUser.id,
            id: '', 
            customer: 'Test', 
            created_at: '', 
            items: [{
                name: "Produkt",
                amount: 1,
                unit: "szt.",
                price: 0.01,
                vat: 23,
                vat_value: 0.00,
                net_value: 0.00,
                gross_value: 0.00,
                invoice_id: 0
              }] 
            } 
		}
    },
    watch: {
        invoice:  {
            handler: function(oldValue, newValue) {
                this.createDraft()
            },
            deep: true
        }
    },
    methods: {
        upList() {
            this.$emit('upList');
        },
        createInvoice(){
            axios.post('/api/invoices', this.invoice)
              .then((response) => {
                this.$router.push('/faktury/' + response.data)
              })
              .catch(function (error) {
                console.log(error);
              });

        },
         createDraft: _.debounce(
              function () {
                console.log(this.invoice.id)
                axios.post('/api/invoices', this.invoice)
                .then((response) => {
                    this.invoice.id = response.data
                })
                this.upList()
              },
              // This is the number of milliseconds we wait for the
              // user to stop typing.
              500
            )
    }
};


</script>
