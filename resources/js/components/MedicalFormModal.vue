<script setup lang="ts">

import InputError from '@/components/InputError.vue';
import { DialogClose } from 'radix-vue';
import TextArea from '@/components/TextArea.vue';
import ActionModal from '@/components/ActionModal.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import RadioInput from '@/components/RadioInput.vue';
import { MedicalForm } from '@/types';
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { vMaska } from 'maska/vue';

const props = defineProps<{
    medicalForm?: MedicalForm,
    url: string,
    triggerButtonText: string
    isUpdate: boolean
}>();

const medicalForm = props.medicalForm;
const user = usePage().props.auth.user
const form = useForm({
    ...(medicalForm.id ? {id: medicalForm.id} : {}),
    patient_name: medicalForm.patient_name ?? '',
    gender: medicalForm.gender ?? '',
    birth_date: medicalForm.birth_date ?? '',
    cpf: medicalForm.cpf ?? '',
    card_sus: medicalForm.card_sus ?? '',
    phone: medicalForm.phone ?? '',
    address: medicalForm.address ?? '',
    primary_care_clinic: medicalForm.primary_care_clinic ?? '',
    community_health_worker: medicalForm.community_health_worker ?? '',
    diagnosis: medicalForm.diagnosis ?? '',
    comorbidity: medicalForm.comorbidity ?? '',
    last_hospitalization: medicalForm.last_hospitalization ?? '',
    registered_by: medicalForm.registered_by ?? user.name,
    doctor_name: medicalForm.doctor_name ?? '',
    priority: medicalForm.priority ?? '',
    registered: medicalForm.registered ?? new Intl.DateTimeFormat('en-CA').format(new Date()),
    tenant_id: medicalForm.tenant_id ?? user.tenant_id
});

const open = ref(false);


const submit = () => {
    if (props.isUpdate) {
        form.put(route(props.url), {
            preserveState: false,
            onSuccess: () => {
                console.log(usePage().props.flash);
                //...
            },
            onError: () => {
                //...
            },
            onFinish: () => {
                form.reset();
                open.value = false;
            }
        });
    } else {
        form.post(route(props.url), {
            preserveState: false,
            onSuccess: () => {
                //...
            },
            onError: () => {
                //...
            },
            onFinish: () => {
                form.reset();
                open.value = false;
            }
        });
    }
};
</script>

<template>
    <ActionModal title="Informações do Atendimento" :triggerButton="props.triggerButtonText" v-model:open="open">
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
                <!-- cpf -->
                <div class="grid gap-2">
                    <Label for="cpf">CPF</Label>
                    <Input
                        id="cpf"
                        type="text"
                        required
                        autofocus
                        :tabindex="2"
                        autocomplete="cpf"
                        v-model="form.cpf"
                        placeholder="ex.: 000.000.000-00"
                        v-maska="'###.###.###-##'"
                    />
                    <InputError :message="form.errors?.cpf" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <!-- gender -->
                <div>
                    <p class="text-[14px] font-[500] mb-2">Sexo</p>
                    <div class="grid grid-cols-2 gap-2">
                        <RadioInput :tabindex="3" label="Feminino" htmlfor="female" id="female" value="female"
                                    bgColor="teal" v-model="form.gender" />

                        <RadioInput :tabindex="4" label="Masculino" htmlfor="male" id="male" value="male" bgColor="teal"
                                    v-model="form.gender" />
                    </div>
                    <InputError :message="form.errors?.gender" />
                </div>
                <!-- birth date -->
                <div class="grid gap-2">
                    <Label for="birth_date">Data de nascimento</Label>
                    <Input id="birth_date" type="date" required autofocus :tabindex="5" autocomplete="birth_date"
                           v-model="form.birth_date" />
                    <InputError :message="form.errors?.birth_date" />
                </div>
                <!-- sus card name -->
                <div class="grid gap-2">
                    <Label for="card_sus">Cartão SUS</Label>
                    <Input
                        id="card_sus"
                        type="text"
                        required
                        autofocus
                        :tabindex="6"
                        autocomplete="card_sus"
                        v-model="form.card_sus"
                        placeholder="ex.: 000.000.000-00"
                        v-maska="'### #### #### ####'"
                    />
                    <InputError :message="form.errors?.card_sus" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <!-- address -->
                <div class="col-span-2 grid gap-2">
                    <Label for="address">Endereço</Label>
                    <Input
                        id="address"
                        type="text"
                        required
                        autofocus
                        :tabindex="7"
                        autocomplete="address"
                        v-model="form.address"
                        placeholder="ex.: Rua das Flores, 123"
                    />
                    <InputError :message="form.errors?.address" />
                </div>
                <!-- contact/phone -->
                <div class="grid gap-2">
                    <Label for="phone">Contato</Label>
                    <Input
                        id="phone"
                        type="text"
                        required
                        autofocus
                        :tabindex="8"
                        autocomplete="phone"
                        v-model="form.phone"
                        placeholder="ex.: (00) 00000-0000"
                        v-maska="'(##) # ####-####'"
                    />
                    <InputError :message="form.errors?.phone" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- diagnosis -->
                <div class="grid gap-2">
                    <Label for="diagnosis">Diagnóstico clínico</Label>
                    <TextArea
                        id="diagnosis"
                        required
                        autofocus
                        :tabindex="9"
                        autocomplete="diagnosis"
                        v-model="form.diagnosis"
                        placeholder="Descrição"
                    />
                    <InputError :message="form.errors?.diagnosis" />
                </div>
                <!-- comorbidity -->
                <div class="grid gap-2">
                    <Label for="comorbidity">Comorbidades Associadas</Label>
                    <TextArea
                        id="comorbidity"
                        required
                        autofocus
                        :tabindex="10"
                        autocomplete="comorbidity"
                        v-model="form.comorbidity"
                        placeholder="Descrição"
                    />
                    <InputError :message="form.errors?.comorbidity" />
                </div>
            </div>

            <div class="grid grid-cols-3">
                <!-- priority -->
                <div class="col-span-2 mr-6">
                    <p class="text-[14px] font-[500] mb-2">Prioridade</p>
                    <div class="grid grid-cols-3 gap-3">
                        <RadioInput
                            :tabindex="11"
                            label="Alta prioridade"
                            htmlfor="high"
                            id="high"
                            value="high"
                            bgColor="red"
                            v-model="form.priority"
                        />
                        <RadioInput
                            :tabindex="12"
                            label="Média prioridade"
                            htmlfor="medium"
                            id="medium"
                            value="medium"
                            bgColor="amber"
                            v-model="form.priority"
                        />
                        <RadioInput
                            :tabindex="13"
                            label="Baixa prioridade"
                            htmlfor="low"
                            id="low"
                            value="low"
                            bgColor="teal"
                            v-model="form.priority"
                        />

                        <InputError :message="form.errors?.priority" />
                    </div>
                    <InputError :message="form.errors?.priority" />
                </div>
                <!-- last hospitalization -->
                <div class="grid gap-2">
                    <Label for="last_hospitalization">Última internação</Label>
                    <Input
                        id="last_hospitalization"
                        type="date"
                        required
                        autofocus
                        :tabindex="14"
                        autocomplete="last_hospitalization"
                        v-model="form.last_hospitalization"
                    />
                    <InputError :message="form.errors?.last_hospitalization" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <!-- ubs name -->
                <div class="grid gap-2">
                    <Label for="primary_care_clinic">Nome da UBS</Label>
                    <Input
                        id="primary_care_clinic"
                        type="text"
                        required
                        autofocus
                        :tabindex="16"
                        autocomplete="primary_care_clinic"
                        v-model="form.primary_care_clinic"
                        placeholder="ex.: UBS"
                    />
                    <InputError :message="form.errors?.primary_care_clinic" />
                </div>
                <!-- acs name -->
                <div class="grid gap-2">
                    <Label for="community_health_worker">ACS Responsável</Label>
                    <Input
                        id="community_health_worker"
                        type="text"
                        autofocus
                        :tabindex="17"
                        autocomplete="community_health_worker"
                        v-model="form.community_health_worker"
                        placeholder="ex.: Joana de Souza"
                    />
                    <InputError :message="form.errors?.community_health_worker" />
                </div>
                <!-- doctor name -->
                <div class="grid gap-2">
                    <Label for="doctor_name">Médico Responsável</Label>
                    <Input
                        id="doctor_name"
                        type="text"
                        required
                        autofocus
                        :tabindex="18"
                        autocomplete="doctor_name"
                        v-model="form.doctor_name"
                        placeholder="ex.: José da Silva"
                    />
                    <InputError :message="form.errors?.doctor_name" />
                </div>
            </div>
            <!-- Dynamics fields - backend -->
            <!-- registered date -->
            <div class="grid hidden gap-2">
                <Label for="registered">Data de cadastro</Label>
                <Input id="registered" type="date" autofocus autocomplete="registered" v-model="form.registered" />
                <InputError :message="form.errors?.registered" />
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
