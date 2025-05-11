<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import TableData from '@/components/TableData.vue';
import TableBody from '@/components/TableBody.vue';
import TableHead from '@/components/TableHead.vue';
import Pagination from '@/components/Pagination.vue';
import TableRow from '@/components/TableRow.vue';
import ActionBar from '@/components/ActionBar.vue';
import ToastList from '@/components/ToastList.vue';
import { type BreadcrumbItem, MedicalForm } from '@/types';
import { Head } from '@inertiajs/vue3';
import { provide, ref } from 'vue';


const props = defineProps<{ medicalForms: object }>();

const items = ref<MedicalForm[]>(props.medicalForms.data || []);

provide('items', items);

const updateItems = (sortedItems: MedicalForm[]) => {
    items.value = sortedItems;
};

provide('updateItems', updateItems);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/home',
    },
];
</script>
<template>
    <Head title="Home" />
    <ToastList/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="rounded-xl p-4">
            <div class="grid auto-rows-min md:grid-cols-1 overflow-hidden">
                <div class="flex flex-col align-top justify-between">
                    <ActionBar/>
                    <TableData>
                        <TableHead @updateItems="updateItems"/>
                        <TableBody>
                            <TableRow />
                        </TableBody>
                    </TableData>
                    <pagination :elements="props.medicalForms"></pagination>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
