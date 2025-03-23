<script setup lang="ts">

import { defineEmits, inject, ref } from 'vue';
import FilterButton from '@/components/FilterButton.vue';

const childRef = ref(null);
const items = inject<MedicalForm[]>('items', []);
const emit = defineEmits(['updateItems']);


const getIsAscending = () => {
    if (childRef.value) {
        return childRef.value.isAscending
    }
    return null;
};

const order = (attribute) => {
    const isAscending = getIsAscending();
    console.log('value', isAscending)
    const sortedItems = [...items.value].sort((a, b) => {
        if (a[attribute] > b[attribute]) return isAscending ? 1 : -1;
        if (a[attribute] < b[attribute]) return isAscending ? -1 : 1;
        return 0;
    });

    // Emitindo os itens ordenados para o Dashboard
    emit('updateItems', sortedItems);
};
</script>

<template>
    <thead>
    <tr class="bg-gray-100 text-gray-700 border-b">
        <th class="flex justify-center p-4 text-xs font-[600] uppercase text-gray-500">
            <div class="flex items-center gap-4">
                Prioridade
                <FilterButton ref="childRef" attribute="priority" @filterSort="order('priority')"/>
            </div>
        </th>
        <th class="p-4 text-xs text-center font-[600] uppercase text-gray-500">Nome</th>
        <th class="p-4 text-xs text-center font-[600] uppercase text-gray-500">CPF</th>
        <th class="flex justify-center p-4 text-xs text-center font-[600] uppercase text-gray-500">
            <div class="flex items-center gap-4">
                Data de registro
                <FilterButton ref="childRef" attribute="priority" @filterSort="order('registered')"/>
            </div>
        </th>
        <th class="p-4 text-xs text-center font-[600] uppercase text-gray-500">Ver mais</th>
    </tr>
    </thead>
</template>

<style scoped>

</style>
