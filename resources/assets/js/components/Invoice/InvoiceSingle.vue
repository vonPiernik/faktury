<template>
<div>
	<div class="dash-content-main">
		<div :class="['panel-body']">
			<div class="invoice-body" v-if="invoice && invoice.id">
				<h1>Faktura nr {{ invoice.id }} dla {{ invoice.customer }}</h1>
				<small>Data wystawienia: {{ invoice.created_at }}</small> 
				<hr>
				<table class="table table-striped"> 
		            <thead>
		            <tr>
		                <td>Nazwa</td>
		                <td>Cena</td>
		                <td>Ilość</td>
		                <td>Wartość netto</td>
		                <td>Stawka VAT</td>
		                <td>Kwota VAT</td>
		                <td>Wartość brutto</td>
		            </tr>
		            </thead>
		            <tbody>
		            
		                <tr v-for="item in invoice.items" :key="item.id">
		                    <td>{{ item.name }}</td>
		                    <td>{{ item.price }} zł</td>
		                    <td>{{ item.amount }} {{ item.unit }}</td>
		                    <td>{{ item.net_value }} zł</td>
		                    <td>{{ item.vat }}%</td>
		                    <td>{{ item.vat_value }} zł</td>
		                    <td>{{ item.gross_value }} zł</td>
		                </tr>

		            </tbody>
		        </table>
				<button class="saveButton">Pobierz (PDF)</button>
				<router-link 
					:to="{ name: 'invoices-edit', params: { invoiceId: invoice.id }}"
					tag="button"
					class="editButton">
						Edytuj fakturę
				</router-link>
				<button class="deleteButton" 
						@click.prevent="deleteInv(invoice.id)">
							Usuń fakturę
				</button>
			</div>
		</div>
	</div>
</div>
</template>

<script>
module.exports = {
	props: ['invoice'],
    data: function() { 
        return { 
        }; 
    }, 
    created(){
        if(this.$route.params.invoiceId){
	    	this.showInv(this.$route.params.invoiceId)
	        this.$emit('setPTitle', "Faktura nr " + this.$route.params.invoiceId)
	    }
    },
    methods: {
        showInv(id) {
            this.$emit('showInv');
        },
        deleteInv(id) {
            this.$emit('deleteInv',id);
        },
    }
 
};


</script>
