<template>
<div>
	<div class="dash-content-main">
		<h3 class="placeholder">Wybierz fakturę z listy lub <router-link 
											:to="{ name: 'faktury/create'}"
											tag="a">utwórz nową</router-link></h3>
	</div>
</div>
</template>

<script>
module.exports = {
    data: function() { 
        return { 
        }; 
    }, 
 
};


</script>
