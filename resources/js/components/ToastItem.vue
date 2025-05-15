<script setup lang="ts">
import {onMounted, computed} from "vue";

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: 'info' // info, success, error, warning
    },
    duration: {
        type: Number,
        default: 5000
    }
});

const typeClasses = computed(() => {
    switch (props.type) {
        case 'success':
            return {
                bg: 'bg-green-100 dark:bg-green-800',
                text: 'text-green-500 dark:text-green-200',
                icon: 'M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z'
            };
        case 'error':
            return {
                bg: 'bg-red-100 dark:bg-red-800',
                text: 'text-red-500 dark:text-red-200',
                icon: 'M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z'
            };
        case 'warning':
            return {
                bg: 'bg-yellow-100 dark:bg-yellow-800',
                text: 'text-yellow-500 dark:text-yellow-200',
                icon: 'M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z'
            };
        default: // info
            return {
                bg: 'bg-blue-100 dark:bg-blue-800',
                text: 'text-blue-500 dark:text-blue-200',
                icon: 'M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z'
            };
    }
});

onMounted(() => {
    setTimeout(() => emit("remove"), props.duration);
});

const emit = defineEmits(["remove"]);
</script>

<template>
    <div
        class="flex items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-800 dark:text-gray-400"
        role="alert"
    >
        <div
            :class="[typeClasses.bg, typeClasses.text, 'inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg']"
        >
            <svg
                aria-hidden="true"
                class="h-5 w-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    :d="typeClasses.icon"
                    clip-rule="evenodd"
                ></path>
            </svg>
            <span class="sr-only">{{ props.type }} icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ props.message }}</div>
        <button
            @click="emit('remove')"
            type="button"
            class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
            aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <svg
                aria-hidden="true"
                class="h-5 w-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                ></path>
            </svg>
        </button>
    </div>
</template>
