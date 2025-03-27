<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import TableData from '@/components/TableData.vue';
import TableBody from '@/components/TableBody.vue';
import TableHead from '@/components/TableHead.vue';
import Pagination from '@/components/Pagination.vue';
import { type BreadcrumbItem, MedicalForm } from '@/types';
import { Head } from '@inertiajs/vue3';
import { provide, ref } from 'vue';
import { Input } from '@/components/ui/input';
import { Search } from 'lucide-vue-next'
import SwitchSlider from '@/components/SwitchSlider.vue';
import { Button } from '@/components/ui/button';

const props = defineProps<{ medicalForms: object }>();

const items = ref<MedicalForm[]>(props.medicalForms.data || []);

provide('items', items);

const updateItems = (sortedItems: MedicalForm[]) => {
    items.value = sortedItems;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/home',
    },
];

</script>

<template>
    <Head title="Home" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="rounded-xl p-4">
            <div class="grid auto-rows-min md:grid-cols-1">
                <div class="flex flex-col align-top justify-between">
                    <div class="grid lg:grid-cols-3 bg-white shadow-sm p-4 mb-8 rounded-sm border">
                        <div class="relative w-full max-w-sm items-center">
                            <Input id="search" type="text" placeholder="Pesquisar" class="pl-10 rounded-sm" />
                            <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
                                <Search class="size-5 text-gray-400" />
                            </span>
                        </div>

                        <div class="flex gap-3 w-full max-w-sm justify-center items-center">
                            <SwitchSlider />
                            <p>Somente meus atendimentos</p>
                        </div>
                        <div class="flex w-full justify-end items-center">
                            <Button name="new_medical_form" class="rounded-sm px-4">Novo Atendimento</Button>
                        </div>
                    </div>
                    <TableData>
                        <TableHead @updateItems="updateItems"/>
                        <TableBody />
                    </TableData>
                    <pagination :elements="props.medicalForms"></pagination>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
