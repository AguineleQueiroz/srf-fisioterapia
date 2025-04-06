<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';
import srf from '@images/srf.svg'

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="relative hidden h-full flex-col bg-muted p-10 text-white dark:border-r lg:flex">
            <div class="absolute inset-0 flex justify-center items-center">
                <img :src="srf" class="w-[85%]"
                     alt="Imagem contendo um médico clínico geral, uma médica e uma enfermeira">
            </div>
        </div>
        <div class="lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <Link :href="route('home')" class="relative z-20 flex items-center justify-center text-lg font-medium text-teal-700">
                    <AppLogoIcon class="mr-2 size-8 fill-current text-teal-700" />
                    <!--{{ name }}-->
                </Link>
                <div class="flex flex-col space-y-2 text-center">
                    <h1 class="text-xl font-medium tracking-tight" v-if="title">{{ title }}</h1>
                    <p class="text-sm text-muted-foreground" v-if="description">{{ description }}</p>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
