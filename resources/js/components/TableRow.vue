<script setup lang="ts">
interface Props {
    content: string;
}

defineProps<Props>();

</script>

<template>
    <tr>
        <td> {{ content }} </td>
    </tr>
</template>

<style scoped>
// ...
</style>
