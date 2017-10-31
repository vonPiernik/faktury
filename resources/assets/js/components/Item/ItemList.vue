<template>
	<div>
	<button type="button" class="add-item" @click="addItem"> Dodaj element</button>
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

        <item-row v-for="(item,index) in invoice.items" 
        			:key="index" 
        			:i="index" 
        			:item="item" 
        			:productList="productList"
        			:currentUser="currentUser"
        			v-on:remove="removeItem(index)">
        </item-row>

		</tbody>

	</table>


	</div>
</template>


<script>
module.exports = {
	props: ['invoice','currentUser'],
	data: function () {
		return {
			productList: ""
		}
	}, 
	created(){
		this.loadProductList()
	},
	methods: {
		addItem(){
			this.invoice.items.push({
				id: "",
			  	name: "",
			  	amount: 1,
			  	unit: "szt.",
			  	price: 0.01,
			  	vat: 23,
			  	vat_value: 0.00,
			  	net_value: 0.00,
			  	gross_value: 0.00,
                invoice_id: 0
			  })
		},
        loadProductList() {
            axios.get(`/api/users/`+ this.currentUser.id + `/products?fields=id,name`).then(response => { 
                this.productList = response.data
            }) 
        },
		removeItem(index){
			Vue.delete(this.invoice.items,index)
			if(this.invoice.items.length == 0){
				this.addItem()
			}
		}
	}
};

</script>