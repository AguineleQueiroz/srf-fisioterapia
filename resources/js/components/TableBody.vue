<script setup lang="ts">
defineProps<{
    items: any;
}>();
</script>

<template>
    <tbody>
        <tr v-for="item in items" :key="item.id" class="border-b hover:bg-gray-100">
            <td class="p-4">{{ item.patient_name }}</td>
            <td class="p-4">{{ item.cpf }}</td>
            <td class="p-4">{{ item.phone }}</td>
            <td class="p-4">{{ item.card_sus }}</td>
        </tr>
    </tbody>
</template>

<style scoped>

</style>
