<script setup lang="ts">
import { computed, inject } from 'vue';
import { MedicalForm } from '@/types';
import Icon from '@/components/Icon.vue';
import { ChevronDown } from 'lucide-vue-next';

const items = inject<MedicalForm[]>('items', []);

const color = computed(() => {
    const colorMap: Record<string, string> = {
        high: '#FF8383',
        low: '#A7D477',
        medium: '#FBD288',
    };
    return (level: string) => colorMap[level] || '#EEEEEE';
});

const toggleExpansiveRows = (trId) => {
    const el = document.getElementById(`tr-${trId}`);

    if (!el.classList.contains('hidden')) {
        el.classList.add('hidden');
        return;
    }

    document.querySelectorAll('.expansive-tr').forEach((tr) => {
        tr.classList.add('hidden');
    });

    el.classList.remove('hidden');
};

</script>

<template>
    <template v-for="item in items" :key="item.id">
        <tr class="cursor-pointer border-b even:bg-gray-50 hover:bg-gray-100">
            <td class="flex justify-center p-4">
                <Icon name="circle" size="24" :color="color(item.priority)" stroke-width="1" />
            </td>
            <td class="p-4 text-center">{{ item.patient_name }}</td>
            <td class="p-4 text-center">{{ item.formatted_cpf || '---' }}</td>
            <td class="p-4 text-center">{{ item.formatted_registered }}</td>
            <td class="flex justify-center p-4" @click="toggleExpansiveRows(item.id)">
                <ChevronDown class="text-teal-700" />
            </td>
        </tr>
        <tr :id="'tr-'+item.id" class="expansive-tr hidden">
            <td colspan="6" class="p-4">
                <div>lorem ipsum dolor et all memento mori</div>
            </td>
        </tr>
    </template>
</template>

<style scoped></style>
