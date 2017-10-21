<template>
    <div class="panel panel-default"> 
        
                        <div class="panel-heading">{{ page.title }}</div> 
                         
 
                        <div class="dash-content-main"> 
                            <div class="messageDraft">{{ page.messageDraft }}</div>
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

                                    <input type="submit" value="Zapisz fakturę" id="saveInvoice">

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
		  	title: "Nowa faktura",
            messageDraft: ""
		  },
          doNotTriggerUpdate: false,

          invoice: { 
            user_id: this.currentUser.id,
            id: '', 
            customer: 'Test',
            draft: true,
            created_at: '', 
            items: [{
                id: "",
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
                if(this.doNotTriggerUpdate){
                    this.doNotTriggerUpdate = false
                    return
                }
                this.page.messageDraft = ""
                if(this.invoice.id){
                    this.updateDraft();
                } else {
                    this.createDraft();
                }
            },
            deep: true
        }
    },
    methods: {
        upList() {
            this.$emit('upList');
        },
        createInvoice(){
            this.doNotTriggerUpdate = true
            this.invoice.draft = false
            axios.post('/api/invoices', this.invoice)
              .then((response) => {
                this.upList()
                this.$router.push('/faktury/' + response.data.id)
              })
              .catch(function (error) {
                console.log(error);
              });

        },
        createDraft: _.debounce(
            function () {
                this.page.messageDraft = "Zapisuję..."
                axios.post('/api/invoices', this.invoice)
                .then((response) => {
                    this.doNotTriggerUpdate = true;

                    this.invoice.id = response.data.id
                    _.forEach(this.invoice.items, function(value, key) {
                        value.id = response.data.items[key].id

                    });

                    this.upList()
                    this.page.messageDraft = "Zapisano"
                })
            },
            // This is the number of milliseconds we wait for the
            // user to stop typing.
            1500
        ),
        updateDraft: _.debounce(
            function () {
                this.page.messageDraft = "Zapisuję..."
                axios.put('/api/invoices/' + this.invoice.id, this.invoice)
                .then((response) => {
                    this.doNotTriggerUpdate = true;

                    _.forEach(this.invoice.items, function(value, key) {
                        value.id = response.data.items[key].id

                    });

                    this.upList()
                    this.page.messageDraft = "Zapisano"
                })
            },
            // This is the number of milliseconds we wait for the
            // user to stop typing.
            1500
        )
    }
};


</script>
