<script setup lang="ts">
import { SwitchRoot, SwitchThumb } from 'radix-vue'
import { ref } from 'vue'
const switchState = ref(false)
</script>

<template>
    <div class="flex lg:gap-2 items-center">
        <label class="order-1 lg:order-0 text-white text-[15px] leading-none pr-[15px] select-none" for="medical_forms_mode" />
        <SwitchRoot
            id="airplane-mode" v-model:checked="switchState"
            class="order-0 lg:order-1 w-[62px] h-[23px] flex bg-gray-300 shadow-sm rounded-full
                relative data-[state=checked]:bg-teal-700 cursor-default" >

            <SwitchThumb
                class="block w-[17px] h-[17px] my-auto bg-white shadow-sm rounded-full transition-transform duration-100
                    translate-x-0.5 will-change-transform data-[state=checked]:bg-white data-[state=checked]:translate-x-[41px]"
            />

        </SwitchRoot>
    </div>
</template>

<style scoped>

</style>
