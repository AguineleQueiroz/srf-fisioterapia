<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import logSrf from '@images/logo-srf.svg'

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="logSrf" alt="SRF Fisioterapia - logomarca">
</template>
