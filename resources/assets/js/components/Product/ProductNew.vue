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
				<input type="submit" value="Dodaj produkt" class="saveButton">
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
        this.$emit('setPTitle', "Nowy produkt")
    },
    methods: {
        upList() {
            this.$emit('upList');
        },
        createProduct(){
        	console.log(JSON.stringify(this.product))
            axios.post('/api/users/'+ this.currentUser.id + '/products', this.product)
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
              })
              .catch(function (error) {
                console.log(error);
              });

        }
    }
};


</script>
