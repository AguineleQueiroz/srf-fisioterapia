<script setup lang="ts">
import { cn } from '@/lib/utils';
import { computed } from 'vue';

const props = defineProps<{
    label?: string;
    htmlfor?: string;
    id?: string;
    defaultValue?: string | number;
    modelValue?: string | number;
    value: string | number;
    class?: string;
    bgColor?: 'red' | 'amber' | 'blue' | 'teal' | 'green' | 'indigo'; // Tailwind-safe cores
}>();

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void;
}>();

const checked = computed(() => props.modelValue === props.value);

function updateValue() {
    emits('update:modelValue', props.value);
}

const bgColorMap = {
    red: 'peer-checked:border-red-500 peer-checked:bg-red-500 peer-checked:text-red-500',
    amber: 'peer-checked:border-amber-500 peer-checked:bg-amber-500 peer-checked:text-amber-500',
    blue: 'peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-blue-500',
    teal: 'peer-checked:border-teal-500 peer-checked:bg-teal-500 peer-checked:text-teal-500',
    green: 'peer-checked:border-green-500 peer-checked:bg-green-500 peer-checked:text-green-500',
    indigo: 'peer-checked:border-indigo-500 peer-checked:bg-indigo-500 peer-checked:text-indigo-500',
};

const textColorMap = {
    red: 'peer-checked:text-red-500',
    amber: 'peer-checked:text-amber-500',
    blue: 'peer-checked:text-blue-500',
    teal: 'peer-checked:text-teal-500',
    green: 'peer-checked:text-green-500',
    indigo: 'peer-checked:text-indigo-500',
};

const selectedColorClass = computed(() => {
    return bgColorMap[props.bgColor ?? 'blue'];
});

const selectedTextColorClass = computed(() => {
    return textColorMap[props.bgColor ?? 'black'];
});
</script>

<template>
    <label :for="htmlfor" class="flex cursor-pointer items-center gap-2 rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">
        <input type="radio" :id="id" :value="value" :checked="checked" @change="updateValue" class="peer hidden" />
        <span :class="cn('h-4 w-4 rounded-full border-2 border-gray-400 transition-colors', selectedColorClass)"></span>
        <span :class="cn('text-[14px] font-[500] transition-colors', selectedTextColorClass)">
            {{ label }}
        </span>
    </label>
</template>
