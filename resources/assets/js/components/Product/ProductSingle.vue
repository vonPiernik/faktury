<template>
<div>
	<div class="dash-content-main">
		<div :class="['panel-body']">
			<div class="product-body" v-if="product && product.id">
				<h1>{{ product.name }}</h1>
				<small>utworzono: {{ product.created_at }}</small> 
				<hr>
				<table class="table table-striped"> 
		            <thead>
		            <tr>
		                <td>Domyślna jednostka</td>
		                <td>Domyślna cena</td>
		                <td>Kod produktu</td>
		            </tr>
		            </thead>
		            <tbody>
		            
		                <tr>
		                    <td>{{ product.unit }}</td>
		                    <td>{{ product.price }}</td>
		                    <td>{{ product.code }}</td>
		                </tr>

		            </tbody>
		        </table>
				<router-link 
					:to="{ name: 'products-edit', params: { productId: product.id }}"
					tag="button"
					class="editButton">
						Edytuj produkt
				</router-link>
				<button class="deleteButton" 
						@click.prevent="deleteProd(product.id)">
							Usuń produkt
				</button>
			</div>
		</div>
	</div>
</div>
</div>
</template>

<script>
module.exports = {
	props: ['product'],
    data: function() { 
        return { 
        }; 
    }, 
    created(){
        if(this.$route.params.productId){
        	console.log("ping")
	    	this.showProd(this.$route.params.productId)
	        this.$emit('setPTitle', "Faktura nr " + this.$route.params.productId)
	    }
    },
    methods: {
        showProd(id) {
            this.$emit('showProd');
        },
        deleteProd(id) {
            this.$emit('deleteProd',id);
        },
    }
 
};


</script>
