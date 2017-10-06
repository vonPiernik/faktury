<template>
	<div>
	<table class="table table-striped items">
	    <thead>
	        <tr>
	            <td>Nazwa</td>
	            <td>Ilość</td>
	            <td>Jednostka</td>
	            <td>Cena</td>
	            <td>Wartość netto</td>
	            <td>Wartość brutto</td>
	        </tr>
	    </thead>
	    <tbody>
		<button type="button" @click="addItem"> Dodaj element</button>

        <item-row v-for="(item,index) in items" 
        			:key="index" 
        			:i="index" 
        			:item="item" 
        			v-on:remove="removeItem(index)">
        </item-row>
        
		</tbody>

	</table>
	</div>
</template>


<script>
// Task list template
module.exports = {
	data: function () {
	return {
	  items: [{
	  	name: "Produkt",
	  	amount: "0",
	  	unit: "szt.",
	  	price: "0",
	  	net_value: "0",
	  	gross_value: "0"
	  }]
	};
	},
	methods: {
		addItem(){
			this.items.push({
			  	name: "Produkt",
			  	amount: "0",
			  	unit: "szt.",
			  	price: "0",
			  	net_value: "0",
			  	gross_value: "0"
			  })
		},
		removeItem(index){
			// this.items.splice(index,1)
			Vue.delete(this.items,index)
		}
	}
};

</script>