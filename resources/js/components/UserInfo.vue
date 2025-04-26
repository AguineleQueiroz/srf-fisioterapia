<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { computed } from 'vue';

interface Props {
    user: User;
    showEmail?: boolean;
    showProfessionalType?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
    showProfessionalType: true,
});

const types = {
    admin: 'Administrador',
    manager: 'Gerente',
    basic: 'Atendimento Básico',
    primary: 'Atenção Primária',
    secondary: 'Atenção Secundária',
    other: 'Atenção Geral',
}

const userType = computed(() => {
    return types.hasOwnProperty(props.user?.professional_type) ? types[props.user?.professional_type] : '---'
});
</script>

<template>
    <div class="grid flex-1 text-left text-sm leading-tight">
        <span class="truncate font-medium">{{ user.name }}</span>
        <!--<span v-if="showEmail" class="truncate text-xs text-muted-foreground">{{ user.email }}</span>-->
        <span v-if="userType" class="truncate text-xs text-muted-foreground">{{ userType }}</span>
    </div>
</template>
