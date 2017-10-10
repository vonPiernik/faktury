<template>
<div>
	<div class="dash-content-sidebar">
		<ul class="invoices-list">
			<li v-for="inv in list"><a href="#" @click.prevent="showInvoice(inv.id)">
				<strong>{{ inv.customer }}</strong>
				<small> {{ inv.created_at }}</small>
			</a></li>
		</ul>
	</div>
	<div class="dash-content-main">
		<div class="panel-body">
			<div class="invoice-body" v-if="invoice.id">
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
		            
		                <tr v-for="item in invoice.items">
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

			</div>
		</div>
	</div>
</div>
</template>

<script>
module.exports = {
     data: function() { 
        return { 
            list: [], 
            invoice: { 
                id: '', 
                customer: 'Placeholder dla klienta', 
                created_at: '', 
                items: {} 
            } 
        }; 
    }, 
     
    created() { 
        axios.get(`api/invoices`) 
        .then(response => { 
             this.list = response.data 
        }) 
    }, 
     
    methods: {  
        showInvoice(id) { 
 
 
            axios.get(`api/invoices/` + id).then(response => { 
                this.invoice = response.data
            }) 
        } 
    } 
};


</script>
