<template>
<div>
	<li v-for="inv in list">
        <router-link
            v-if="inv.draft" 
            :to="{ name: 'invoices-edit', params: {  invoiceId: inv.id }}"
            tag="a"
            class="draft">
                <strong>{{ inv.customer }} <span>(wersja robocza)</span></strong>
                <small> {{ inv.created_at | formatDate }}</small>
        </router-link>
        <router-link
            v-else
            :to="{ name: 'invoices-show', params: { invoiceId: inv.id }}"
            tag="a"
            class="final">
                <strong>{{ inv.customer }}</strong>
                <small> {{ inv.created_at | formatDate }}</small>
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
