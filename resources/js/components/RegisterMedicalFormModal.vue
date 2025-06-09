<script setup lang="ts">

import InputError from '@/components/InputError.vue';
import { DialogClose } from 'radix-vue';
import ActionModal from '@/components/ActionModal.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';


const props = defineProps<{
    medicalFormId: number,
    url: string,
    triggerButtonText: string
}>();

const user = usePage().props.auth.user
const form = useForm({
    patient_name: '',
    tenant_id: user.tenant_id
});

const open = ref(false);

const submit = () => {
    form.post(route('add-medical-form'), {
        onFinish: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <ActionModal title="Informações da Atenção Primária" :triggerButton="props.triggerButtonText" v-model:open="open">
        <!--modal content-->
        <form @submit.prevent="submit" class="grid grid-cols-1 gap-y-6">
            <div class="grid grid-cols-3 gap-6">
                <!-- patient name -->
                <div class="col-span-2 grid gap-2">
                    <Label for="patient_name">Paciente</Label>
                    <Input
                        id="patient_name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="patient_name"
                        v-model="form.patient_name"
                        placeholder="ex.: João da Silva"
                    />
                    <InputError :message="form.errors?.patient_name" />
                </div>
            </div>
            <!--submit modal button-->
            <div class="mt-[25px] flex justify-end gap-6">
                <DialogClose as-child>
                    <button
                        type="reset"
                        class="text-dark inline-flex h-[35px] items-center justify-center rounded-sm bg-gray-300 px-8 text-sm font-[500] hover:bg-gray-400 focus:outline-none"
                    >
                        Cancelar
                    </button>
                </DialogClose>
                <button
                    type="submit"
                    class="inline-flex h-[35px] items-center justify-center rounded-sm bg-teal-700 px-10 text-sm font-[500] text-white hover:bg-teal-800 focus:outline-none"
                >
                    Salvar
                </button>
            </div>
        </form>
    </ActionModal>
</template>
