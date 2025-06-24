<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Not Found" />
    <AppLayout>
        <div class="flex flex-col lg:flex-row justify-between w-full lg:h-[500px] gap-12 lg:gap-0">
            <div class="flex justify-end pt-8 w-full lg:order-first order-last">
                <img src="../../images/seeker.svg" alt="seeker">
            </div>

            <div class="grid grid-cols-1 text-center w-full space-x-6 text-teal-700 order-first lg:order-last">
                <div class="p-0 m-0">
                    <span class="text-[108px] mb-0">404</span>
                </div>

                <div class="text-[38px] lg:mb-[-40px]">
                    OOOps!
                    <br />
                    Página não encontrada
                </div>

                <p class="text-teal-700 text-lg">
                    Esta página não existe ou foi movida!
                    <br />
                    Nós sugerimos retornar para a homepage
                </p>

                <div class="mt-8 lg:mt-0">
                    <Link :href="route('forms.index')" class="bg-teal-700 hover:bg-teal-900 text-white p-4 rounded-sm">
                        VOLTAR PARA PÁGINA PRINCIPAL
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.element-error-page {
    background-color: #ffffff;
    display: flex;
    flex-direction: row;
    justify-content: center;
    width: 100%;
}

.element-error-page .div {
    background-color: #ffffff;
    height: 768px;
    position: relative;
    width: 1366px;
}


.element-error-page .element {
    background-image: url(../../images/seeker.svg);
    background-size: 100% 100%;
    height: 626px;
    position: relative;
    top: 142px;
    width: 673px;
}

.element-error-page .group {
    height: 495px;
    left: 830px;
    position: absolute;
    top: 188px;
    width: 386px;
}

.element-error-page .text-wrapper {
    color: #000000;
    font-family: "Concert One-Regular", Helvetica,serif;
    font-size: 202px;
    font-weight: 400;
    left: 36px;
    letter-spacing: 0;
    line-height: normal;
    position: absolute;
    text-align: center;
    top: 0;
    white-space: nowrap;
}

.element-error-page .ooops-page-not-found {
    color: #000000;
    font-family: "Clash Grotesk-Light", Helvetica,serif;
    font-size: 46px;
    font-weight: 300;
    left: 39px;
    letter-spacing: 0;
    line-height: normal;
    position: absolute;
    text-align: center;
    top: 218px;
}

.element-error-page .this-page-doesn-t {
    color: #b0b0b0;
    font-family: "Clash Grotesk-Medium", Helvetica,serif;
    font-size: 21px;
    font-weight: 500;
    left: 0;
    letter-spacing: 0;
    line-height: normal;
    position: absolute;
    text-align: center;
    top: 364px;
    width: 380px;
}

.element-error-page .overlap-group-wrapper {
    height: 48px;
    left: 100px;
    position: absolute;
    top: 447px;
    width: 182px;
}

.element-error-page .overlap-group {
    background-color: #000000;
    height: 48px;
    position: relative;
    width: 180px;
}

.element-error-page .text-wrapper-2 {
    color: #ffffff;
    font-family: "Clash Grotesk-Medium", Helvetica,serif;
    font-size: 14px;
    font-weight: 500;
    left: 32px;
    letter-spacing: 0;
    line-height: normal;
    position: absolute;
    text-align: center;
    top: 16px;
}
</style>
