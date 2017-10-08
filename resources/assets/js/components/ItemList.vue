<template>
	<div>
	<button type="button" @click="addItem"> Dodaj element</button>
	<table class="table table-striped items">
	    <thead>
	        <tr>
	            <td>Nazwa</td>
	            <td>Ilość</td>
	            <td>Jednostka</td>
	            <td>Cena</td>
	            <td>Stawka VAT (%)</td>
	            <td>Kwota VAT</td>
	            <td>Wartość netto</td>
	            <td>Wartość brutto</td>
	        </tr>
	    </thead>
	    <tbody>

        <item-row v-for="(item,index) in items" 
        			:key="index" 
        			:i="index" 
        			:item="item" 
        			v-on:remove="removeItem(index)">
        </item-row>

		</tbody>

	</table>

	<input type="hidden" v-model="itemsAmount" name="items_amount">

	</div>
</template>


<script>
module.exports = {
	data: function () {
	return {
	  items: [{
	  	name: "Produkt",
	  	amount: 1,
	  	unit: "szt.",
	  	price: 0.01,
	  	vat: 23,
	  	vat_value: 0.00,
	  	net_value: 0.00,
	  	gross_value: 0.00
	  }],
	  itemsAmount: 0
	}
	}, 
	methods: {
		addItem(){
			this.items.push({
			  	name: "Produkt",
			  	amount: 1,
			  	unit: "szt.",
			  	price: 0.01,
			  	vat: 23,
			  	vat_value: 0.00,
			  	net_value: 0.00,
			  	gross_value: 0.00
			  })
			this.itemsAmount++;
		},
		removeItem(index){
			Vue.delete(this.items,index)
			this.itemsAmount--;
		}
	}
};

</script>