<script setup lang="ts">
import { computed, inject  } from 'vue';
import { MedicalForm } from '@/types'
import Icon from '@/components/Icon.vue';
import { ChevronDown } from 'lucide-vue-next';

const items = inject<MedicalForm[]>('items', []);

const color = computed(
    ()=>{
        const colorMap: Record<string, string> = {
            high: '#FF8383',
            low: '#A7D477',
            medium: '#FBD288',
        };
        return (level: string) => colorMap[level] || '#EEEEEE';
    }
);
</script>

<template>
    <tbody>
        <tr v-for="item in items" :key="item.id" class="cursor-pointer border-b hover:bg-gray-100 even:bg-gray-50">
            <td class="p-4 flex justify-center">
                <Icon name="circle" size="24" :color="color(item.priority)" stroke-width="1" />
            </td>
            <td class="p-4 text-center">{{ item.patient_name }}</td>
            <td class="p-4 text-center">{{ item.formatted_cpf || '---' }}</td>
            <td class="p-4 text-center">{{ item.formatted_registered }}</td>
            <td class="flex justify-center p-4">
                <ChevronDown class="text-teal-700"/>
            </td>
        </tr>
    </tbody>
</template>

<style scoped></style>
