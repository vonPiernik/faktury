<template id="item-template">

        <tr class="items-row items-row-1">
            <td><input required type="text" value="Pozycja" name="name_1" style="width: 100%;"></td>
            <td><input required  min="0" value="0" type="number" name="amount_1" style="width: 50px;"></td>
            <td><input required type="text" value="szt." name="unit_1" size="4"></td>
            <td><input required  min="0" value="0" type="number" name="price_1" style="width: 50px;"></td>
            <td><input required  min="0" value="0" type="number" name="net_value_1" style="width: 50px;"></td>
            <td><input required  min="0" value="0" type="number" name="gross_value_1" style="width: 50px;"></td>
            <td><button type="button" v-on:click= "remove"> X </button></td>
        </tr>

</template>
