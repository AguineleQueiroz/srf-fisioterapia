<script setup lang="ts">

import { inject, ref } from 'vue';
import FilterButton from '@/components/FilterButton.vue';

const childRef = ref(null);
const items = inject<MedicalForm[]>('items', []);
const emit = defineEmits(['updateItems']);


const getIsAscending = () => {
    if (childRef.value) {
        return childRef.value.isAscending;
    }
    return null;
};

const order = (attribute) => {
    const isAscending = getIsAscending();
    const sortedItems = [...items.value].sort((a, b) => {
        if (a[attribute] > b[attribute]) return isAscending ? 1 : -1;
        if (a[attribute] < b[attribute]) return isAscending ? -1 : 1;
        return 0;
    });
    emit('updateItems', sortedItems);
};
</script>

<template>
    <thead>
        <tr class="bg-gray-100 text-gray-700 border-b">
            <th class="flex justify-center p-4 text-xs font-[600] uppercase text-gray-500 w-[162px]">
                <div class="flex itext-start">
                    Prioridade
                    <FilterButton ref="childRef" :attribute="'priority'" @filterSort="order('priority')"/>
                </div>
            </th>
            <th class="p-4 text-xs text-start font-[600] uppercase text-gray-500 w-[454px]">Nome</th>
            <th class="p-4 text-xs text-start font-[600] uppercase text-gray-500 w-[194px]">CPF</th>
            <th class="flex justify-start p-4 text-xs text-start  font-[600] uppercase text-gray-500 w-[247px]">
                <div class="flex items-center gap-2">
                    Data de registro
                    <FilterButton ref="childRef" :attribute="'registered'" @filterSort="order('registered')"/>
                </div>
            </th>
            <th class="p-4 text-xs text-center font-[600] uppercase text-gray-500 w-[124px]">Ver mais</th>
        </tr>
    </thead>
</template>
