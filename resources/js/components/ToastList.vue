<script setup lang="ts">
import ToastItem from '@/components/ToastItem.vue';
import { onUnmounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import toast from '@/stores/toast';

const page = usePage();
const removeFinishEventListener = router.on('finish', () => {
    if (page.props.flash?.success) {
        toast.add({
            message: page.props.flash.success,
            type: 'success'
        });
    }

    if (page.props.flash?.error) {
        toast.add({
            message: page.props.flash.error,
            type: 'error'
        });
    }

    if (page.props.flash?.warning) {
        toast.add({
            message: page.props.flash.warning,
            type: 'warning'
        });
    }
});

onUnmounted(() => removeFinishEventListener());

function remove(index) {
    toast.remove(index);
}
</script>
<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed right-4 top-4 z-50 w-full max-w-xs space-y-4"
    >
        <ToastItem
            v-for="(item, index) in toast.items"
            :key="item.key"
            :message="item.message"
            :type="item.type || 'info'"
            :duration="5000"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>
