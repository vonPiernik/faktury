<template>
    <tr class="items-row">
            <td><input required type="text" v-model="item.name" name="name_1" style="width: 100%;"></td>
            <td><input required  min="0" v-model="item.amount" type="number" name="amount_1" style="width: 50px;"></td>
            <td><input required type="text" v-model="item.unit" name="unit_1" size="4"></td>
            <td><input required  min="0" v-model="item.price" type="number" name="price_1" style="width: 50px;"></td>
            <td><input required  min="0" v-model="item.net_value" type="number" name="net_value_1" style="width: 50px;"></td>
            <td><input required  min="0" v-model="item.gross_value" type="number" name="gross_value_1" style="width: 50px;"></td>
            <td><button type="button" @click="remove"> X </button></td>
    </tr>
</template>

<script>
// Task list template
module.exports = {
    props: ['item', 'i'],
    methods: {
        remove() {
            this.$emit('remove');
        } 
    }
};

</script>