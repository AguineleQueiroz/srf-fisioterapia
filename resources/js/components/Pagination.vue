<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
defineProps(['elements']);

const decodeHtml = (html: string) => {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
};

</script>

<template>
    <div id="pagination"
         class="w-full flex justify-center pt-4 mt-4 items-center">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in elements.links" :key="key">
                <div v-if="link.url === null"
                     class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded">
                    {{ decodeHtml(link.label) }}
                </div>
                <Link v-else
                      class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-teal-700 focus:text-teal-700"
                      :class="{ 'bg-teal-700 text-white': link.active }" :href="link.url">
                    {{ decodeHtml(link.label) }}
                </Link>
            </template>
        </div>
    </div>
</template>


<style scoped>

</style>
