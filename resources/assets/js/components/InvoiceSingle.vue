<template>
<div>
	<div class="dash-content-main">
		<!-- <h3 class="placeholder" v-if="invoice.id == ''">Wybierz fakturę z listy lub <router-link 
											:to="{ name: 'faktury/create'}"
											tag="a">utwórz nową</router-link></h3> -->
		<div :class="[invoice.blured, 'panel-body']">
			<div class="invoice-body">
				<h1 v-if="invoice.id">Faktura nr {{ invoice.id }} dla {{ invoice.customer }}</h1>
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
	props: ['invoice'],
    data: function() { 
        return { 
        }; 
    }, 
     
 
};


</script>
