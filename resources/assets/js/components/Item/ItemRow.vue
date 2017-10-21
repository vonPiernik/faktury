<template>
    <tr class="items-row">
            <td>
                <input required type="text"
                         v-model="item.name" 
                         :name="'name'">
            </td>
            <td>
                <input required  min="0" step="0.01" 
                v-model.number="item.amount" 
                @change="computeValues(item.amount)" 
                type="number" 
                :name="'amount'">
            </td>
            <td>
                <input required 
                type="text" 
                v-model="item.unit" 
                :name="'unit'" size="4">
            </td>
            <td>
                <input required  min="0.01" step="0.01"
                v-model.number="item.price" 
                @change="computeValues(item.price)" 
                type="number" 
                :name="'price'">
            </td>
            <td>
                <input required  min="1" max="100"
                v-model.number="item.vat" 
                @change="computeValues(item.vat)" 
                type="number" 
                :name="'vat'">
            </td>
            <td>
                <input readonly required  min="0.01" step="0.01"
                v-model.number="item.vat_value" 
                @change="computeValues(item.vat_value)" 
                type="number" 
                :name="'vat_value'">
            </td>
            <td>
                <input required  min="0" step="0.01"
                v-model.number="item.net_value" 
                @change="computeValues(item.net_value)" 
                type="number" 
                :name="'net_value'">
            </td>
            <td><input required  min="0" step="0.01"
                v-model.number="item.gross_value" 
                @change="computeValues(item.gross_value)" 
                type="number" 
                :name="'gross_value'">
            </td>
            <td><button type="button" class="removeItemButton" @click="remove"> X </button></td>

    </tr>
</template>

<style>
    input[type="number"]{
        width: 80px;
    }
</style>

<script>
module.exports = {
    props: ['item', 'i'],
    data: function () {
        return {
        
        }
    }, 
    methods: {
        remove() {
            this.$emit('remove');
        },
        computeValues(whatChanged){
            vatV = (this.item.vat / 100) + 1;

            if(whatChanged == this.item.price || whatChanged == this.item.amount){
                this.item.net_value = (this.item.price * this.item.amount).toFixed(2)
                this.item.gross_value = (this.item.net_value * vatV).toFixed(2)
                this.item.vat_value = (this.item.net_value * (this.item.vat / 100)).toFixed(2)
            } else if(whatChanged == this.item.vat) {
                this.item.gross_value = (this.item.net_value * vatV).toFixed(2)
                this.item.vat_value = (this.item.net_value * (this.item.vat / 100)).toFixed(2)
            } else if(whatChanged == this.item.vat_value) {

            } else if(whatChanged == this.item.net_value) {
                this.item.gross_value = (this.item.net_value * vatV).toFixed(2)
                this.item.price = (this.item.net_value / this.item.amount).toFixed(2)
                this.item.vat_value = (this.item.net_value * (this.item.vat / 100)).toFixed(2)
            } else if(whatChanged == this.item.gross_value) {
                this.item.net_value = (this.item.gross_value / vatV).toFixed(2)
                this.item.price = (this.item.net_value / this.item.amount).toFixed(2)
                this.item.vat_value = (this.item.net_value * (this.item.vat / 100)).toFixed(2)
            }

        }
    }
};


</script>