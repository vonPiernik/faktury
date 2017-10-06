<template>
    <li><slot></slot>{{ item.task }}</li>
</template>

<script>
// Task list template
module.exports = {
    props: ['item']
};

</script>