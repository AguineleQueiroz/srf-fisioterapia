<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogDescription,
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
    registered_by: '',
    doctor_name: '',
    priority: '',
    registered: '',
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
                class="data-[state=open]:animate-contentShow fixed top-[35%] left-[50%] max-h-[225vh] w-[225vw]
                max-w-[450px] translate-x-[-50%] translate-y-[-50%] rounded-sm bg-white p-6
                shadow-md focus:outline-none z-[100]"
            >
                <DialogTitle class="m-0 mb-4 font-[500] text-gray-800">
                    Novo Atendimento
                </DialogTitle>

                <!--modal content-->
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Paciente</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            v-model="form.name"
                            placeholder="Nome completo"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="address">Endereço</Label>
                        <Input
                            id="address"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="address"
                            v-model="form.address"
                            placeholder="Ex: Rua das Flores, 123"
                        />
                        <InputError :message="form.errors.address" />
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
