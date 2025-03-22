<script setup lang="ts">
import TableHead from '@/components/TableHead.vue';
</script>

<template>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full bg-white shadow-lg overflow-hidden">
            <table class="w-full border-collapse">
                <TableHead/>
                <slot />
            </table>
        </div>
    </div>
</template>

<style scoped></style>
