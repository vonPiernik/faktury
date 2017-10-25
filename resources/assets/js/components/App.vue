<template>
	<div v-bind:class="[{dimmed} , 'component-core']">
	   <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="/">
                        <!-- <img src="{{ url('/') }}/images/logo-bmale.png" alt="Fakturnis"> -->
                        Simins
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav" v-if="currentUser.id">
                         <!-- Authentication Links -->
                        <!-- <li><router-link to="/faktury">Twoje faktury</router-link></li>
                        <li><router-link to="/invoices-nowa">Nowa faktura</router-link></li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                            <li v-if="!currentUser.id"><a href="/login">Login</a></li>
                            <li v-if="!currentUser.id"><a href="/register">Register</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ currentUser.name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/logout">
                                            Logout
                                        </a>

                                    </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

     
 




<div class="container-fluid"> 
            <div class="row"> 
                <div class="dash-sidebar"> 
                    <ul class="left-menu">
                        <li>
                            <router-link
                                :to="{ name: 'invoices-dash' }"
                                tag="a">
                                    <img src="/images/icons/invoices.png">Twoje faktury
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                :to="{ name: 'invoices-create' }"
                                tag="a">
                                    <img src="/images/icons/new-invoice.png">Nowa faktura
                            </router-link>
                        </li>
<!--                         <li>
                            <router-link
                                :to="{ path: '#' }"
                                tag="a">
                                    <img src="/images/icons/draft.png">Wersje robocze
                            </router-link>
                        </li> -->
                        <li>
                            <router-link
                                :to="{ name: 'invoices-trash' }"
                                tag="a">
                                    <img src="/images/icons/delete.png">Kosz
                            </router-link>
                        </li>
                        <hr>
                        <li>
                            <router-link
                                :to="{ name: 'products' }"
                                tag="a">
                                    <img src="/images/icons/products.png">Twoje produkty
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                :to="{ name: 'products-create' }"
                                tag="a">
                                    <img src="/images/icons/add-product.png">Nowy produkt
                            </router-link>
                        </li>
                        <hr>
                        <li>
                            <router-link
                                :to="{ name: 'customers' }"
                                tag="a">
                                    <img src="/images/icons/clients.png">Twoi klienci
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                :to="{ name: 'customers-create' }"
                                tag="a">
                                    <img src="/images/icons/add-client.png">Nowy klient
                            </router-link>
                        </li>
                        <hr>
                        <li>
                            <router-link
                                :to="{ path: '#' }"
                                tag="a">
                                    <img src="/images/icons/stats.png">Statystyki
                            </router-link>
                        </li>
                    </ul> 
                </div> 
                <div class="dash-content"> 

	      <!-- router outlet -->
                <router-view :currentUser="currentUser"
                             @switchL="switchLight"
                             :dimmed="dimmed">
                                 
                             </router-view>
                </div> 
            </div><!-- /.row --> 
        </div><!-- /.container --> 
		</div>

	</div>
</template>


<script>
module.exports = {
    props: ['currentUser'],
    data: function () {
        return {
            dimmed: false
        }
    }, 
    methods: {
        switchLight: function(off){
            if(off == 'off'){
                this.dimmed = false
            } else {
                this.dimmed = !this.dimmed
            }
        }
    }
};


</script>