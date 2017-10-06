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
        			v-on:remove="removeItem(index)"
        			v-on:inputFire="onInput(item, 'price', $event)">
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
	  	amount: 0,
	  	unit: "szt.",
	  	price: 0,
	  	net_value: 0,
	  	gross_value: 0,
	  	itemIndex: 0
	  }]
	}
	}, 
	watch: {
	    items: {
	    handler: function (val, oldVal) {
	    	val.forEach(function(item, index){
		    	val[index].net_value = val[index].amount * val[index].price;
		    })
	    	str = JSON.stringify(val);
			str = JSON.stringify(val, null, 4); // (Optional) beautiful indented output.
			console.log(str); 
			console.log(val[0].name)
	    },
	    deep: true
	    }
    },
	methods: {
		addItem(){
			this.items.push({
			  	name: "Produkt",
			  	amount: 0,
			  	unit: "szt.",
			  	price: 0,
			  	net_value: 0,
			  	gross_value: 0
			  })
		},
		removeItem(index){
			// this.items.splice(index,1)
			Vue.delete(this.items,index)
		}
	}
};

</script>