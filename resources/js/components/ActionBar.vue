<script setup lang="ts">

import SwitchSlider from '@/components/SwitchSlider.vue';
import NewMedicalFormModal from '@/components/NewMedicalFormModal.vue';
import { Search } from 'lucide-vue-next';
import { Input } from '@/components/ui/input';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'

const searchQuery = ref('');
const search = () => {
    if(searchQuery.value.trim()) router.get(route('dashboard'), { search: searchQuery.value });
}
</script>

<template>
    <div class="grid [sm,md]:grid-rows-3 lg:grid-cols-3 gap-3 w-full bg-white shadow-sm p-4 mb-8 rounded-sm border">
        <div class="relative w-full items-center">
            <Input id="search"
                   type="text"
                   placeholder="Pesquisar"
                   class="pl-10 rounded-sm"
                   v-model="searchQuery"
                   @keydown.enter="search"
            />
            <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
                <Search class="size-5 text-gray-400" />
            </span>
        </div>

        <div class="flex lg:gap-3 w-full max-w-sm justify-start lg:justify-center items-center">
            <SwitchSlider />
            <p>Somente meus atendimentos</p>
        </div>
        <div class="flex w-full lg:justify-end items-center">
            <NewMedicalFormModal />
        </div>
    </div>
</template>
