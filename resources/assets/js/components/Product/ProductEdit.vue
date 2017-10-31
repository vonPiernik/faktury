<template>
<div class="panel panel-default">
	<div class="dash-content-main">
		<div class="panel-body">
			<form method="POST" action="#" @submit.prevent="createProduct">

				<div class="col-md-12">
					<label class="labelDefault">Nazwa produktu: </label>
					<input required type="text" name="name" v-model="product.name">
				</div>
				<div class="col-md-4">
					<label class="labelDefault">Domyślna jednostka: </label>
					<input type="text" name="unit" v-model="product.unit">
				</div>
				<div class="col-md-4">
					<label class="labelDefault">Domyślna cena: </label>
					<input type="number"  min="0.01" step="0.01" name="price" v-model="product.price">
				</div>
				<div class="col-md-4">
					<label class="labelDefault">Kod produktu: </label>
					<input type="text" name="code" v-model="product.code">
				</div>
				<br><br>
				<hr>
				<input type="submit" value="Zapisz zmiany" class="updateButton">
			</form>
		</div>
	</div>
</div>
</template>

<script>
module.exports = {
    props: ['currentUser','list'],
     data: function() { 
        return { 
            product: { 
                id: '',
	            user_id: this.currentUser.id,
                name: '', 
                unit: '',
                price: '',
                code: '',
            } 
        }; 
    },

    created() {
        this.$emit('setPTitle', "Edytuj produkt")
        axios.get(`/api/users/`+ this.currentUser.id + `/products/` + this.$route.params.productId).then(response => { 
                this.product = response.data
        })
    },
    methods: {
        upList() {
            this.$emit('upList');
        },
        createProduct(){
            axios.put('/api/users/'+ this.currentUser.id + '/products/'+this.$route.params.productId, this.product)
              .then((response) => {
                this.upList()
                this.product = { 
	                id: '',
		            user_id: this.currentUser.id,
	                name: '', 
	                unit: '',
	                price: '',
	                code: '',
	            } 

                this.$router.push('/produkty/' + response.data.id)
              })
              .catch(function (error) {
                console.log(error);
              });

        }
    }
};


</script>
