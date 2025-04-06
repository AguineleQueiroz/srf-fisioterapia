<script setup lang="ts">
import {
    DialogClose,
    DialogContent,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
    DialogTrigger
} from 'radix-vue';
import { X } from 'lucide-vue-next';

defineProps({
    title: {
        type: String,
        required: true
    },
    triggerButton: {
        type: String,
        required: true
    }
})

</script>

<template>
    <DialogRoot>
        <!--toggle modal-->
        <DialogTrigger class="text-white font-semibold bg-teal-700 hover:bg-teal-800 rounded-sm px-4 py-2" >
            {{ triggerButton }}
        </DialogTrigger>
        <!--modal-->
        <DialogPortal>
            <DialogOverlay class="bg-gray-700/45 transition-opacity data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
            <DialogContent
                class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[100%] w-[65%]
                max-w-[65%] translate-x-[-50%] translate-y-[-50%] rounded-sm bg-white
                shadow-md focus:outline-none z-[100]"
            >
                <DialogTitle class="m-0 mb-4 font-[500] text-gray-800 p-6 border-b">
                    {{ title }}
                </DialogTitle>

                <div class="overflow-y-auto max-h-[75vh] p-6">
                    <slot />
                </div>

                <DialogClose
                    class="hover:bg-green4 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none"
                    aria-label="Close"
                >
                    <X size="18" class="hover:bg-gray-100 rounded-full" />
                </DialogClose>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>

<style scoped>
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background-color: #186f65; /* teal-500 */
    border-radius: 4px;
}

</style>
