<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import { ref } from 'vue';

const props = defineProps<{
    primaryMedicalForms: object,
    secondaryMedicalForms: object,
}>();

const primaryMedicalForms = ref<primaryMedicalForms[]>(props.primaryMedicalForms.data || []);
//const secondaryMedicalForms = ref<secondaryMedicalForms[]>(props.secondaryMedicalForms.data || []);
console.log(primaryMedicalForms)
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Heading title="Fichas do paciente" description="Visualize todas as fichas cadastradas do paciente" />

        <span> {{ primaryMedicalForms }}</span>
    </AppLayout>
</template>

<style scoped>

</style>
