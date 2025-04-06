<script setup lang="ts">

import SwitchSlider from '@/components/SwitchSlider.vue';
import { Search } from 'lucide-vue-next';
import { Input } from '@/components/ui/input';
import NewMedicalFormModal from '@/components/NewMedicalFormModal.vue';
</script>

<template>
    <div class="grid lg:grid-cols-3 bg-white shadow-sm p-4 mb-8 rounded-sm border">
        <div class="relative w-full max-w-sm items-center">
            <Input id="search" type="text" placeholder="Pesquisar" class="pl-10 rounded-sm" />
            <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
                <Search class="size-5 text-gray-400" />
            </span>
        </div>

        <div class="flex gap-3 w-full max-w-sm justify-center items-center">
            <SwitchSlider />
            <p>Somente meus atendimentos</p>
        </div>
        <div class="flex w-full justify-end items-center">
            <NewMedicalFormModal />
        </div>
    </div>
</template>
