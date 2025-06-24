<script setup lang="ts">
import ActionModal from '@/components/ActionModal.vue';
import InputError from '@/components/InputError.vue';
import TextArea from '@/components/TextArea.vue';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';
import { Label } from '@/components/ui/label';
import { useForm, usePage } from '@inertiajs/vue3';
import { DialogClose } from 'radix-vue';
import { ref } from 'vue';

const props = defineProps<{
    medicalFormId: number;
    url: string;
    triggerButtonText: string;
}>();

const user = usePage().props.auth.user;
const form = useForm({
    //CheckBox and Dynamic TextAreas
    pain: false,
    pain_description: '',
    disability: false,
    disability_description: '',
    musculoskeletal: false,
    musculoskeletal_description: '',
    neurological: false,
    neurological_description: '',
    urogynaecological: false,
    urogynaecological_description: '',
    cardiovascular: false,
    cardiovascular_description: '',
    respiratory: false,
    respiratory_description: '',
    oncological: false,
    oncological_description: '',
    pediatric: false,
    pediatric_description: '',
    multiple_conditions: false,
    multiple_conditions_description: '',

    //textareas
    complaint: '',
    physical_exam_findings: '',
    standardized_tests: '',
    functional_condition: '',
    environmental_factors: '',
    physiotherapeutic_diagnosis: '',

    //checkboxes
    mova_se: false,
    menos_dor_mais_saude: false,
    peso_saudavel: false,
    geracao_esporte: false,
    none_alternatives: false,

    ra_mova_se: false,
    ra_menos_dor_mais_saude: false,
    ra_peso_saudavel: false,
    ra_geracao_esporte: false,
    ra_none_alternatives: false,

    //autofilled fields
    basic_medical_form_id: props.medicalFormId,
    tenant_id: user.tenant_id,
});

const open = ref(false);

const submit = () => {
    form.post(route('records.store'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <ActionModal title="Informações da Atenção Primária" :triggerButton="props.triggerButtonText" v-model:open="open">
        <!--modal content-->
        <form @submit.prevent="submit" class="grid grid-cols-1 gap-y-2">
            <div class="grid grid-cols-1 gap-6">
                <!-- CheckBox and Dynamic TextAreas -->
                <div class="flex flex-col gap-2">
                    <h6 class="mb-4">Atenção Primária</h6>
                    <div class="flex flex-col gap-2">
                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.pain" @update:checked="form.pain = $event" name="pain" />
                                <Label for="pain"> Dores </Label>
                            </div>
                            <div v-show="form.pain" id="pain-content-wrapper" class="mb-3">
                                <Label for="pain_description"></Label>
                                <TextArea
                                    id="pain_description"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="pain_description"
                                    v-model="form.pain_description"
                                    placeholder="Descrição"
                                    :required="form.pain"
                                />
                                <InputError :message="form.errors?.pain_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.disability" @update:checked="form.disability = $event" name="disability" />
                                <Label for="disability"> Incapacidades </Label>
                            </div>
                            <div v-show="form.disability" id="disability-content-wrapper" class="mb-3">
                                <Label for="disability_description"></Label>
                                <TextArea
                                    id="disability_description"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="disability_description"
                                    v-model="form.disability_description"
                                    placeholder="Descrição"
                                    :required="form.disability"
                                />
                                <InputError :message="form.errors?.disability_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.musculoskeletal" @update:checked="form.musculoskeletal = $event" name="musculoskeletal" />
                                <Label for="musculoskeletal"> Osteomusculares </Label>
                            </div>
                            <div v-show="form.musculoskeletal" id="musculoskeletal-content-wrapper" class="mb-3">
                                <Label for="musculoskeletal_description"></Label>
                                <TextArea
                                    id="musculoskeletal_description"
                                    :required="form.musculoskeletal"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="musculoskeletal_description"
                                    v-model="form.musculoskeletal_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.musculoskeletal_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.neurological" @update:checked="form.neurological = $event" name="neurological" />
                                <Label for="neurological"> Neurologicas </Label>
                            </div>
                            <div v-show="form.neurological" id="neurological-content-wrapper" class="mb-3">
                                <Label for="neurological_description"></Label>
                                <TextArea
                                    id="neurological_description"
                                    :required="form.neurological"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="neurological_description"
                                    v-model="form.neurological_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.neurological_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox
                                    :checked="form.urogynaecological"
                                    @update:checked="form.urogynaecological = $event"
                                    name="urogynaecological"
                                />
                                <Label for="urogynaecological"> Uroginecologicas </Label>
                            </div>
                            <div v-show="form.urogynaecological" id="urogynaecological-content-wrapper" class="mb-3">
                                <Label for="urogynaecological_description"></Label>
                                <TextArea
                                    id="urogynaecological_description"
                                    :required="form.urogynaecological"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="urogynaecological_description"
                                    v-model="form.urogynaecological_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.urogynaecological_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.cardiovascular" @update:checked="form.cardiovascular = $event" name="cardiovascular" />
                                <Label for="cardiovascular"> Cardiovasculares </Label>
                            </div>
                            <div v-show="form.cardiovascular" id="cardiovascular-content-wrapper" class="mb-3">
                                <Label for="cardiovascular_description"></Label>
                                <TextArea
                                    id="cardiovascular_description"
                                    :required="form.cardiovascular"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="cardiovascular_description"
                                    v-model="form.cardiovascular_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.cardiovascular_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.respiratory" @update:checked="form.respiratory = $event" name="respiratory" />
                                <Label for="respiratory"> Respiratorias </Label>
                            </div>
                            <div v-show="form.respiratory" id="respiratory-content-wrapper" class="mb-3">
                                <Label for="respiratory_description"></Label>
                                <TextArea
                                    id="respiratory_description"
                                    :required="form.respiratory"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="respiratory_description"
                                    v-model="form.respiratory_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.respiratory_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.oncological" @update:checked="form.oncological = $event" name="oncological" />
                                <Label for="oncological"> Oncologicas </Label>
                            </div>
                            <div v-show="form.oncological" id="oncological-content-wrapper" class="mb-3">
                                <Label for="oncological_description"></Label>
                                <TextArea
                                    id="oncological_description"
                                    :required="form.oncological"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="oncological_description"
                                    v-model="form.oncological_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.oncological_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox :checked="form.pediatric" @update:checked="form.pediatric = $event" name="pediatric" />
                                <Label for="pediatric"> Pediatria </Label>
                            </div>
                            <div v-show="form.pediatric" id="pediatric-content-wrapper">
                                <Label for="pediatric_description"></Label>
                                <TextArea
                                    id="pediatric_description"
                                    :required="form.pediatric"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="pediatric_description"
                                    v-model="form.pediatric_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.pediatric_description" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center gap-2">
                                <Checkbox
                                    :checked="form.multiple_conditions"
                                    @update:checked="form.multiple_conditions = $event"
                                    name="multiple_conditions"
                                />
                                <Label for="multiple_conditions"> Múltiplas Condições </Label>
                            </div>
                            <div v-show="form.multiple_conditions" id="multiple_conditions-content-wrapper">
                                <Label for="multiple_conditions_description"></Label>
                                <TextArea
                                    id="multiple_conditions_description"
                                    :required="form.multiple_conditions"
                                    autofocus
                                    :tabindex="10"
                                    autocomplete="multiple_conditions_description"
                                    v-model="form.multiple_conditions_description"
                                    placeholder="Descrição"
                                />
                                <InputError :message="form.errors?.multiple_conditions_description" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TextAreas-->
                <div class="grid gap-2">
                    <h6 class="mb-4">Avaliação Fisioterapêutica</h6>
                    <div class="flex flex-col gap-3">
                        <div class="grid gap-4">
                            <Label for="complaint">Queixas do Paciente</Label>
                            <TextArea
                                id="complaint"
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
                                autofocus
                                :tabindex="10"
                                autocomplete="physiotherapeutic_diagnosis"
                                v-model="form.physiotherapeutic_diagnosis"
                                placeholder="Descrição"
                            />
                            <InputError :message="form.errors?.physiotherapeutic_diagnosis" />
                        </div>
                    </div>
                </div>
                <!--CheckBoxes-->
                <div class="card flex flex-col gap-4">
                    <h6 class="mb-4">Atividades ou grupos operativos que o paciente participa</h6>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.mova_se" @update:checked="form.mova_se = $event" name="mova_se" />
                            <Label for="mova_se"> Mova-se </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox
                                :checked="form.menos_dor_mais_saude"
                                @update:checked="form.menos_dor_mais_saude = $event"
                                name="menos_dor_mais_saude"
                            />
                            <Label for="menos_dor_mais_saude"> Menos Dor Mais Saude </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.peso_saudavel" @update:checked="form.peso_saudavel = $event" name="peso_saudavel" />
                            <Label for="peso_saudavel"> Peso Saudável </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.geracao_esporte" @update:checked="form.geracao_esporte = $event" name="geracao_esporte" />
                            <Label for="geracao_esporte"> Geracao Esporte </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.none_alternatives" @update:checked="form.none_alternatives = $event" name="none_alternatives" />
                            <Label for="none_alternatives"> Nenhuma das Alternativas </Label>
                        </div>
                    </div>
                    <InputError :message="form.errors?.current_activities" />
                </div>

                <div class="card flex flex-col gap-4">
                    <h6 class="mb-4">Atividades ou grupos operativos dos quais o paciente já participou</h6>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.ra_mova_se" @update:checked="form.ra_mova_se = $event" name="ra_mova_se" />
                            <Label for="ra_mova_se"> Mova-se </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox
                                :checked="form.ra_menos_dor_mais_saude"
                                @update:checked="form.ra_menos_dor_mais_saude = $event"
                                name="ra_menos_dor_mais_saude"
                            />
                            <Label for="ra_menos_dor_mais_saude"> Menos Dor Mais Saude </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox :checked="form.ra_peso_saudavel" @update:checked="form.ra_peso_saudavel = $event" name="ra_peso_saudavel" />
                            <Label for="ra_peso_saudavel"> Peso Saudável </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox
                                :checked="form.ra_geracao_esporte"
                                @update:checked="form.ra_geracao_esporte = $event"
                                name="ra_geracao_esporte"
                            />
                            <Label for="ra_geracao_esporte"> Geracao Esporte </Label>
                        </div>

                        <div class="flex items-center gap-2">
                            <Checkbox
                                :checked="form.ra_none_alternatives"
                                @update:checked="form.ra_none_alternatives = $event"
                                name="ra_none_alternatives"
                            />
                            <Label for="ra_none_alternatives"> Nenhuma das Alternativas </Label>
                        </div>
                    </div>
                    <InputError :message="form.errors?.previous_activities" />
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
