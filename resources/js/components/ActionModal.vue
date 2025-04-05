<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    DialogTrigger
} from 'radix-vue';
import { X } from 'lucide-vue-next';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import TextArea from '@/components/TextArea.vue';
import { vMaska } from "maska/vue";
import RadioInput from '@/components/RadioInput.vue';

const form = useForm({
    patient_name: '',//
    gender: '', //
    birth_date: '',//
    cpf: '',//
    card_sus: '',//
    phone: '',//
    address: '',//
    primary_care_clinic: '',//
    community_health_worker: '',//
    diagnosis: '',//
    comorbidity: '',//
    last_hospitalization: '',
    registered_by: '', // adicionar dinamicamente pelo auth::id
    doctor_name: '',//
    priority: '',
    registered: '', // capturar dinamicamente
});

</script>

<template>
    <DialogRoot>
        <!--toggle modal-->
        <DialogTrigger class="text-white font-semibold bg-teal-700 hover:bg-teal-800 rounded-sm px-4 py-2" >
            Novo Atendimento
        </DialogTrigger>
        <!--modal-->
        <DialogPortal>
            <DialogOverlay class="bg-gray-700/45 transition-opacity data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
            <DialogContent
                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[100%] w-[65%]
                max-w-[65%] translate-x-[-50%] translate-y-[-50%] rounded-sm bg-white
                shadow-md focus:outline-none z-[100]"
            >
                <DialogTitle class="m-0 mb-4 font-[500] text-gray-800 p-6 border-b">
                    Novo Atendimento
                </DialogTitle>

                <div class="overflow-y-auto max-h-[75vh] p-6">
                    <!--modal content-->
                    <form @submit.prevent="submit" class="grid grid-cols-1 gap-y-6">
                        <div class="grid grid-cols-3 gap-6">
                            <!-- patient name -->
                            <div class="grid col-span-2 gap-2">
                                <Label for="name">Paciente</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="name"
                                    v-model="form.name"
                                    placeholder="ex.: João da Silva"
                                />
                                <InputError :message="form.errors.name" />
                            </div>
                            <!-- cpf -->
                            <div class="grid gap-2">
                                <Label for="cpf">CPF</Label>
                                <Input
                                    id="cpf"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="cpf"
                                    v-model="form.cpf"
                                    placeholder="ex.: 000.000.000-00"
                                    v-maska="'###.###.###-##'"
                                />
                                <InputError :message="form.errors.cpf" />
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <!-- gender -->
                            <div class="grid gap-2">
                                <span class="text-[14px] font-[500]">Sexo</span>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <RadioInput
                                            label="Feminino"
                                            htmlfor="female"
                                            id="female"
                                            value="female"
                                            bgColor="teal"
                                            v-model="form.gender"
                                        />
                                    </div>

                                    <div>
                                        <RadioInput
                                            label="Masculino"
                                            htmlfor="male"
                                            id="male"
                                            value="male"
                                            bgColor="teal"
                                            v-model="form.gender"
                                        />
                                    </div>
                                </div>
                                <InputError :message="form.errors.gender" />
                            </div>
                            <!-- birth date -->
                            <div class="grid gap-2">
                                <Label for="birth_date">Data de nascimento</Label>
                                <Input
                                    id="birth_date"
                                    type="date"
                                    required
                                    autofocus
                                    autocomplete="birth_date"
                                    v-model="form.birth_date"
                                />
                                <InputError :message="form.errors.birth_date" />
                            </div>
                            <!-- sus card name -->
                            <div class="grid gap-2">
                                <Label for="card_sus">Cartão SUS</Label>
                                <Input
                                    id="card_sus"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="card_sus"
                                    v-model="form.card_sus"
                                    placeholder="ex.: 000.000.000-00"
                                    v-maska="'### #### #### ####'"
                                />
                                <InputError :message="form.errors.card_sus" />
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <!-- address -->
                            <div class="grid col-span-2 gap-2">
                                <Label for="address">Endereço</Label>
                                <Input
                                    id="address"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="address"
                                    v-model="form.address"
                                    placeholder="ex.: Rua das Flores, 123"
                                />
                                <InputError :message="form.errors.address" />
                            </div>
                            <!-- contact/phone -->
                            <div class="grid gap-2">
                                <Label for="phone">Contato</Label>
                                <Input
                                    id="phone"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="phone"
                                    v-model="form.phone"
                                    placeholder="ex.: (00) 00000-0000"
                                    v-maska="'(##) # ####-####'"
                                />
                                <InputError :message="form.errors.phone" />
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
                                    autocomplete="diagnosis"
                                    v-model="form.diagnosis"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors.diagnosis" />
                            </div>
                            <!-- comorbidity -->
                            <div class="grid gap-2">
                                <Label for="comorbidity">Comorbidades Associadas</Label>
                                <TextArea
                                    id="comorbidity"
                                    required
                                    autofocus
                                    autocomplete="comorbidity"
                                    v-model="form.comorbidity"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors.comorbidity" />
                            </div>
                        </div>

                        <div class="grid grid-cols-3">
                            <!-- priority -->
                            <div class="grid col-span-2 gap-2">
                                <span class="text-[14px] font-[500]">Prioridade</span>
                                <div class=" grid grid-cols-3">
                                    <div>
                                        <RadioInput
                                            label="Alta prioridade"
                                            htmlfor="high"
                                            id="high"
                                            value="high"
                                            bgColor="red"
                                            v-model="form.priority"
                                        />
                                    </div>

                                    <div>
                                        <RadioInput
                                            label="Média prioridade"
                                            htmlfor="medium"
                                            id="medium"
                                            value="medium"
                                            bgColor="amber"
                                            v-model="form.priority"
                                        />
                                    </div>

                                    <div>
                                        <RadioInput
                                            label="Baixa prioridade"
                                            htmlfor="low"
                                            id="low"
                                            value="low"
                                            bgColor="teal"
                                            v-model="form.priority"
                                        />
                                    </div>
                                </div>
                                <InputError :message="form.errors.priority" />
                            </div>
                            <!-- last hospitalization -->
                            <div class="grid gap-2">
                                <Label for="last_hospitalization">Última internação</Label>
                                <Input
                                    id="last_hospitalization"
                                    type="date"
                                    required
                                    autofocus
                                    autocomplete="last_hospitalization"
                                    v-model="form.last_hospitalization"
                                />
                                <InputError :message="form.errors.last_hospitalization" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <!-- ubs name -->
                            <div class="grid gap-2">
                                <Label for="primary_care_clinic">Nome da UBS</Label>
                                <Input
                                    id="primary_care_clinic"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="primary_care_clinic"
                                    v-model="form.primary_care_clinic"
                                    placeholder="ex.: UBS"
                                />
                                <InputError :message="form.errors.primary_care_clinic" />
                            </div>
                            <!-- doctor name -->
                            <div class="grid gap-2">
                                <Label for="doctor_name">Médico Responsável</Label>
                                <Input
                                    id="doctor_name"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="doctor_name"
                                    v-model="form.doctor_name"
                                    placeholder="ex.: José da Silva"
                                />
                                <InputError :message="form.errors.doctor_name" />
                            </div>
                        </div>
                        <!-- Dynamics fields - backend -->
                        <!-- acs name -->
                        <div class="grid gap-2 hidden">
                            <Label for="community_health_worker">ACS Responsável</Label>
                            <Input
                                id="community_health_worker"
                                type="text"
                                required
                                autofocus
                                autocomplete="community_health_worker"
                                v-model="form.community_health_worker"
                                placeholder="ex.: Joana de Souza"
                            />
                            <InputError :message="form.errors.community_health_worker" />
                        </div>
                        <!-- registered date -->
                        <div class="grid gap-2 hidden">
                            <Label for="registered">Data de cadastro</Label>
                            <Input
                                id="registered"
                                type="date"
                                required
                                autofocus
                                autocomplete="registered"
                                v-model="form.registered"
                            />
                            <InputError :message="form.errors.registered" />
                        </div>
                        <!--submit modal button-->
                        <div class="mt-[25px] flex justify-end">
                            <DialogClose as-child>
                                <button
                                    class="bg-teal-700 text-white text-[14px] font-[500] hover:bg-teal-800 inline-flex h-[35px] items-center justify-center rounded-sm px-3 focus:outline-none"
                                >
                                    Save changes
                                </button>
                            </DialogClose>
                        </div>
                    </form>
                </div>

                <DialogClose
                    class="hover:bg-green4 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none"
                    aria-label="Close"
                >
                    <X size="18" class="hover:bg-gray-100 rounded-full" />
                </DialogClose>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

<style scoped>
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background-color: #186f65; /* teal-500 */
    border-radius: 4px;
}

</style>
