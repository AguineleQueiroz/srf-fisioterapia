<script setup lang="ts">
import { computed, inject } from 'vue';
import { MedicalForm } from '@/types';
import Icon from '@/components/Icon.vue';
import { ChevronDown, LoaderCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useForm } from '@inertiajs/vue3';

const items = inject<MedicalForm[]>('items', []);

const color: string = computed(() => {
    const colorMap: Record<string, string> = {
        high: '#FF8383',
        low: '#A7D477',
        medium: '#FBD288',
    };
    return (level: string) => colorMap[level] || '#EEEEEE';
});

const calculateAge: string = (date: string) => {
    if (!/^\d{4}-\d{2}-\d{2}$/.test(date)) {
        return "Invalid format date - Valid: 0000-00-00";
    }

    const birthDate = new Date(date);

    if (isNaN(birthDate.getTime())) {
        return "Invalid date";
    }

    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();

    // Ajusta a idade se o aniversário ainda não ocorreu este ano
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    return age;
}

const toggleExpansiveRows = (trId: string) => {
    const el = document.getElementById(`tr-${trId}`);
    const footerEl = document.getElementById(`tr-footer-${trId}`);

    if (!el.classList.contains('hidden') && !footerEl.classList.contains('hidden')) {
        el.classList.add('hidden');
        footerEl.classList.add('hidden');
        return;
    }

    document.querySelectorAll('.expansive-tr').forEach((tr) => {
        tr.classList.add('hidden');
    });

    document.querySelectorAll('.expansive-tr-footer').forEach((tr) => {
        tr.classList.add('hidden');
    });

    el.classList.remove('hidden');
    footerEl.classList.remove('hidden');
};

const form = useForm({
    attention: '',
});

const submit = () => {
    form.post(route('/referral'), {
        onFinish: () => form.reset('attention'),
    });
};
</script>

<template>
    <template v-if="items.length > 0">
        <template v-for="item in items" :key="item.id">
            <tr class="cursor-pointer border-b hover:bg-gray-100 text-sm">
                <td class="flex justify-center p-4 w-[162px]">
                    <Icon name="circle" size="24" :color="color(item.priority)" stroke-width="1" />
                </td>
                <td class="p-4 text-center w-[454px]">{{ item.patient_name }}</td>
                <td class="p-4 text-center w-[194px]">{{ item.formatted_cpf || '---' }}</td>
                <td class="p-4 text-center w-[247px]">{{ item.formatted_registered }}</td>
                <td class="flex justify-center p-4 w-[124px]" @click="toggleExpansiveRows(item.id)">
                    <ChevronDown class="text-teal-700" />
                </td>
            </tr>
            <tr :id="'tr-'+item.id" class="expansive-tr hidden text-sm">
                <td></td>
                <td colspan="4" class="border-b">
                    <!-- Informations -->
                    <div class="border border-t-0 border-r-0 p-4">
                        <h1 class="font-bold mb-2"> Informações: </h1>
                        <div class="flex flex-col flex-wrap max-h-32">
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Sexo: </span>
                                <span class="ms-1">{{item.formatted_gender}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Data de nascimento: </span>
                                <span class="ms-1">{{item.formatted_birthdate}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Idade: </span>
                                <span class="ms-1">{{ calculateAge(item.birth_date) }}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Endereço: </span>
                                <span class="ms-1">{{item.address}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Número do cartão SUS: </span>
                                <span class="ms-1">{{item.card_sus}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Telefone: </span>
                                <span class="ms-1">{{item.phone}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Data do cadastro: </span>
                                <span class="ms-1">{{item.formatted_registered}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Responsável pelo cadastro: </span>
                                <span class="ms-1">{{item.registered_by}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Basic health unit - UBS -->
                    <div class="border border-t-0 border-r-0 p-4">
                        <h1 class="font-bold mb-2">Unidade Básica de Saúde: </h1>
                        <div class="flex max-h-28">
                            <div class="w-full">
                                <span class="font-[500]">Nome da UBS: </span>
                                <span class="ms-1">{{item.primary_care_clinic}}</span>
                            </div>
                            <div class="w-full">
                                <span class="font-[500]">ACS responsável: </span>
                                <span class="ms-1">{{item.community_health_worker}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Health conditions -->
                    <div class="border border-t-0 border-r-0 border-b-0 p-4">
                        <h1 class="font-bold mb-2">Condições de Saúde: </h1>
                        <div class="flex flex-wrap">
                            <div class="flex flex-col lg:w-[50%]">
                                <span class="font-[500]">Diagnóstico clínico: </span>
                                <span class="mb-2">{{item.diagnosis ?? '---'}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Última internação: </span>
                                <span class="ms-1">{{ item.formatted_last_hospitalization }}</span>
                            </div>
                            <div class="flex flex-col lg:w-[50%]">
                                <span class="font-[500]">Comorbidades associadas: </span>
                                <span class="mb-2">{{item.comorbidity  ?? '---'}}</span>
                            </div>
                            <div class="lg:w-[50%]">
                                <span class="font-[500]">Médico responsável: </span>
                                <span class="ms-1">{{item.doctor_name}}</span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr :id="'tr-footer-'+item.id" class="expansive-tr-footer hidden border-b">
                <td></td>
                <td colspan="4">
                    <div class="flex justify-between p-4 border-l">
                        <Button name="edit_medical_form" class="rounded-sm px-4 hover:bg-teal-900">Editar</Button>

                        <Button name="add_medical_form" class="rounded-sm px-4 hover:bg-teal-900">Adicionar Ficha</Button>

                        <Button name="list_medical_forms" class="rounded-sm px-4 hover:bg-teal-900">Fichas do Paciente</Button>


                        <form @submit.prevent="submit" class="flex items-center">
                            <Select v-model="form.attention" name="attention" class="rounded-none" :class="{ 'border-red-500': form.errors.attention }">
                                <SelectTrigger class="h-9 rounded-none rounded-l-md">
                                    <SelectValue placeholder="Atenção:" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem v-for="(type, index ) in ['primary', 'secondary']" :key="'type_'+index" :value="type">
                                            {{ index === 0 ? 'Primária' : 'Secundária' }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <Button type="submit"  class="w-full hover:bg-teal-900 rounded-none rounded-r-md border-0"  :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Encaminhar
                            </Button>
                        </form>
                    </div>
                </td>
            </tr>
        </template>
    </template>
    <template v-else>
        <tr class="w-full text-center">
            <td colspan="5" class="p-6">Nenhum atendimento cadastrado.</td>
        </tr>
    </template>
</template>
