<template>
<div>
	<li v-for="prod in list">
        <router-link
            :to="{ name: 'products-show', params: { productId: prod.id }}"
            tag="a">
                <strong>{{ prod.name }}</strong>
                <small> {{ prod.created_at | formatDate }}</small>
        </router-link>
    </li>
</div>
</div>
</template>

<script>
module.exports = {
    props: ['list'],
    data: function() { 
        return { 
        }; 
    }, 
 
};


</script>

