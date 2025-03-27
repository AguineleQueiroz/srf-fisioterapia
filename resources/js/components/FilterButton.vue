<script setup lang="ts">
import { ArrowUpDown } from 'lucide-vue-next';
import { ref } from 'vue';

const isAscending = ref(null);

const props = defineProps<{ attribute: string}>();
const emit = defineEmits<{
    (event: 'filterSort', attribute: string, direction: boolean): void;
}>();

const sendEvent = (attribute: string) => {
    isAscending.value = !isAscending.value;
    emit('filterSort', attribute);
};

defineExpose({
    isAscending
});

</script>

<template>
    <button @click="sendEvent(props.attribute)">
        <ArrowUpDown class="h-4" />
    </button>
</template>

<style scoped></style>
