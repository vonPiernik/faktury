<template>
    <div class="panel panel-default products"> 
        
                        <div class="panel-heading">{{ page.title }}
                            <router-link v-if="$route.name != 'products-create'"
                                :to="{ name: 'products-create' }"
                                tag="button"
                                class="saveButton">
                                    Nowy produkt
                            </router-link>
                        </div> 
                            <div class="dash-content-sidebar">
                                <ul class="invoices-list" v-if="list[0]">
                                    <product-list :list="list"></product-list>
                                </ul>
                                <div v-else-if="loading" class="invoices-list--placeholder">
                                    <div class="spinner">
                                      <div class="bounce1"></div>
                                      <div class="bounce2"></div>
                                      <div class="bounce3"></div>
                                    </div>
                                </div>
                                <div v-else class="invoices-list--placeholder">
                                    Nie dodałeś jeszcze żadnych produktów
                                </div>
                            </div>
                            <transition name="fade" mode="out-in">
                                <router-view :product="product"
                                             v-on:upList="updateProductsList()"
                                             v-on:showProd="showProduct($route.params.productId)"
                                             v-on:deleteProd="deleteProduct"
                                             :currentUser="currentUser"
                                             @setPTitle="setPageTitle">
                                </router-view>
                            </transition>
                       
    </div>
</template>


<script>
module.exports = {
     props: ['currentUser', 'dimmed'],
     data: function() { 
        return { 
            list: [],
            loading: true,
            page: {
                title: "Twoje produkty"
            },
            product: { 
                blured: "blured",
                id: '',
                name: '', 
                unit: '',
                price: '',
                code: '',
                created_at: '', 
            } 
        }; 
    },

    watch: {
        $route:  {
            handler: function(oldValue, newValue) {
                if(this.$route.params.productId){
                    this.product = _.find(this.list, {'id': this.$route.params.productId}); 
                }
            }
        }
    },

    created() { 
        this.updateProductsList()
    },

    methods: {  
        setPageTitle(newTitle){
            this.page.title = newTitle
        },
        showProduct(id) { 
            axios.get(`/api/users/`+ this.currentUser.id + `/products/` + id).then(response => { 
                this.product = response.data
            }) 
        },
        
        deleteProduct(id) { 
            axios.delete(`/api/users/`+ this.currentUser.id + `/products/` + id).then(response => {
                this.updateProductsList()
                this.$router.push('/produkty')
            }) 
        },

        updateProductsList: _.throttle( function(){
            axios.get(`/api/users/`+ this.currentUser.id + `/products`) 
            .then(response => { 
                this.list = response.data 
                this.loading = false
            }) 
            .catch(function (error) {
                console.log(error);
            });
            
        }, 1000 ) 
    } 
};


</script>
