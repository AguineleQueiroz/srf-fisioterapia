<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DataTable from '@/components/DataTable.vue';
import TableBody from '@/components/TableBody.vue';

defineProps({
    medicalForms: Array
})


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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-1">
                <div class="card">
                    <DataTable>
                        <TableBody :items="medicalForms"/>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
