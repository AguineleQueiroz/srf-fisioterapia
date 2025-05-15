<script setup lang="ts">
import SwitchSlider from '@/components/SwitchSlider.vue';
import { Input } from '@/components/ui/input';
import { router } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';
import { ref } from 'vue';
import MedicalFormModal from '@/components/MedicalFormModal.vue';

const searchQuery = ref('');
const search = () => {
    if (searchQuery.value.trim()) router.get(route('dashboard'), { search: searchQuery.value });
};
</script>

<template>
    <div class="grid w-full rounded-sm border bg-white p-4 shadow-sm mb-8 gap-3 md:grid-cols-3 lg:grid-cols-3">
        <div class="relative items-center w-full md:col-span-1">
            <Input
                id="search"
                type="text"
                placeholder="Nome, CPF ou cartão SUS"
                class="rounded-sm text-sm pl-10"
                v-model="searchQuery"
                @keydown.enter="search"
            />
            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
            <Search class="text-gray-400 size-5" />
        </span>
        </div>

        <div class="flex items-center justify-between w-full md:grid md:grid-cols-2 md:col-span-2">
            <div class="flex items-center lg:gap-3 md:justify-center">
                <SwitchSlider />
                <p class="text-sm">Meus atendimentos</p>
            </div>
            <div class="flex md:justify-end">
                <MedicalFormModal
                    triggerButtonText="Novo Atendimento"
                    :medical-form="{}"
                    url="medical-form"
                    :is-update="false"
                />
            </div>
        </div>
    </div>
</template>
