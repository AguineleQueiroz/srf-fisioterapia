<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import TableData from '@/components/TableData.vue';
import TableBody from '@/components/TableBody.vue';
import TableHead from '@/components/TableHead.vue';
import Pagination from '@/components/Pagination.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

defineProps({
    medicalForms: Object
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
        <div class="rounded-xl p-4">
            <div class="grid auto-rows-min md:grid-cols-1">
                <div class="flex flex-col align-top justify-between">
                    <div class="bg-white shadow-lg p-4 mb-8">
                        text
                    </div>
                    <TableData>
                        <TableHead />
                        <TableBody :items="medicalForms.data" />
                    </TableData>
                    <pagination :elements="medicalForms"></pagination>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
