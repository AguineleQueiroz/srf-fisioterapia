<script setup lang="ts">

import InputError from '@/components/InputError.vue';
import { DialogClose } from 'radix-vue';
import ActionModal from '@/components/ActionModal.vue';
import { Label } from '@/components/ui/label';
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import TextArea from '@/components/TextArea.vue';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';


const props = defineProps<{
    medicalFormId: number,
    url: string,
    triggerButtonText: string
}>();

const user = usePage().props.auth.user
const form = useForm({

    //textareas
    complaint: '',
    physical_exam_findings: '',
    standardized_tests: '',
    functional_condition: '',
    environmental_factors: '',
    physiotherapeutic_diagnosis: '',
    //checkboxes
    mova_se: '',
    menos_dor_mais_saude: '',
    peso_saudavel: '',
    geracao_esporte: '',
    none_alternatives: '',

    ra_mova_se: '',
    ra_menos_dor_mais_saude: '',
    ra_peso_saudavel: '',
    ra_geracao_esporte: '',
    ra_none_alternatives: '',
    //autofilled fields
    basic_medical_form_id: props.medicalFormId,
    tenant_id: user.tenant_id
});

const open = ref(false);

const submit = () => {
    form.post(route('add-health-record'), {
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
                <!-- TextAreas-->
                <div class="col-span-2 grid gap-2">
                    <div class="grid gap-2">
                        <Label for="complaint">Queixas do Paciente</Label>
                        <TextArea
                            id="complaint"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="complaint"
                            v-model="form.complaint"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.complaint" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="physical_exam_findings">Achados Exame Físico</Label>
                        <TextArea
                            id="physical_exam_findings"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="physical_exam_findings"
                            v-model="form.physical_exam_findings"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.physical_exam_findings" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="standardized_tests">Testes Padronizados</Label>
                        <TextArea
                            id="standardized_tests"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="standardized_tests"
                            v-model="form.standardized_tests"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.standardized_tests" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="functional_condition">Condição Funcional</Label>
                        <TextArea
                            id="functional_condition"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="functional_condition"
                            v-model="form.functional_condition"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.functional_condition" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="environmental_factors">Fatores Ambientais</Label>
                        <TextArea
                            id="environmental_factors"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="environmental_factors"
                            v-model="form.environmental_factors"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.environmental_factors" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="physiotherapeutic_diagnosis">Diagnóstico Fisioterapêutico</Label>
                        <TextArea
                            id="physiotherapeutic_diagnosis"
                            required
                            autofocus
                            :tabindex="10"
                            autocomplete="physiotherapeutic_diagnosis"
                            v-model="form.physiotherapeutic_diagnosis"
                            placeholder="Descrição"
                        />
                        <InputError :message="form.errors?.physiotherapeutic_diagnosis" />
                    </div>
                </div>
                <!--CheckBoxes-->

                <div class="card flex flex-wrap justify-center gap-4">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="mova_se" name="mova_se" value="mova_se"/>
                        <Label for="mova_se"> Mova-se </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="menos_dor_mais_saude" name="menos_dor_mais_saude" value="menos_dor_mais_saude"/>
                        <Label for="menos_dor_mais_saude"> Menos Dor Mais Saude </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="peso_saudavel" name="peso_saudavel" value="peso_saudavel"/>
                        <Label for="peso_saudavel"> Peso Saudável </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="geracao_esporte" name="geracao_esporte" value="geracao_esporte"/>
                        <Label for="geracao_esporte"> Geracao Esporte </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="none_alternatives" name="none_alternatives" value="none_alternatives"/>
                        <Label for="none_alternatives"> Nenhuma das Alternativas </Label>
                    </div>
                </div>

                <div class="card flex flex-wrap justify-center gap-4">
                    <div class="flex items-center gap-2">
                        <Checkbox v-model="ra_mova_se" name="ra_mova_se" value="ra_mova_se"/>
                        <Label for="ra_mova_se"> Mova-se </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="ra_menos_dor_mais_saude" name="ra_menos_dor_mais_saude" value="ra_menos_dor_mais_saude"/>
                        <Label for="ra_menos_dor_mais_saude"> Menos Dor Mais Saude </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="peso_saudavel" name="ra_peso_saudavel" value="ra_peso_saudavel"/>
                        <Label for="ra_peso_saudavel"> Peso Saudável </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="ra_geracao_esporte" name="ra_geracao_esporte" value="ra_geracao_esporte"/>
                        <Label for="ra_geracao_esporte"> Geracao Esporte </Label>
                    </div>

                    <div class="flex items-center gap-2">
                        <Checkbox v-model="ra_none_alternatives" name="ra_none_alternatives" value="ra_none_alternatives"/>
                        <Label for="ra_none_alternatives"> Nenhuma das Alternativas </Label>
                    </div>
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
