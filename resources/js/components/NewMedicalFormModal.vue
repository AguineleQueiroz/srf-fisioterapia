<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import MedicalFormModal from '@/components/MedicalFormModal.vue';

const user = usePage().props.auth.user
const form = useForm({
    patient_name: '',
    gender: '',
    birth_date: '',
    cpf: '',
    card_sus: '',
    phone: '',
    address: '',
    primary_care_clinic: '',
    community_health_worker: '',
    diagnosis: '',
    comorbidity: '',
    last_hospitalization: '',
    registered_by: user.name,
    doctor_name: '',
    priority: '',
    registered: new Intl.DateTimeFormat('en-CA').format(new Date()),
    tenant_id: user.tenant_id
});

</script>

<template>
    <MedicalFormModal
        triggerButtonText="Novo Atendimento"
        :medicalForm="form"
        url="medical-form"
        :is-update="false"
    />
</template>
