<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Select, SelectTrigger, SelectContent, SelectGroup, SelectItem, SelectValue } from '@/components/ui/select';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { computed, watch } from 'vue';
import { vMaska } from 'maska/vue';

const props = defineProps({
    tenants: {
        id: Number,
        name: String,
        state_code: String,
        active: Boolean
    },
    userTypes: {
        id: Number,
        type: String,
        code: String,
        active: Boolean
    },
});

const form = useForm({
    name: '',
    email: '',
    cpf: '',
    professional_type: '',
    document: '',
    phone: '',
    address: '',
    city: '',
    password: '',
    password_confirmation: '',
    tenant_id: ''
});

const showDocumentField = computed(() => {
    return form.professional_type !== 'basic';
});

const documentRules = computed(() => {
    if (form.professional_type === 'other') {
        // Any formats...
        return { required: showDocumentField.value };
    } else if (showDocumentField.value) {
        return {
            required: true,
            // 000000-A
            pattern: /^\d{6}-[A-Za-z]$/,
        };
    } else {
        return { required: false };
    }
});

watch(
    () => form.professional_type,
    (newValue) => {
        if (newValue === 'basic') form.document = '';
    },
);

watch(
    () => form.city,
    (newValue) => {
        if (newValue) {
            const selectedTenant = props.tenants.find(t => t.name.toLowerCase() === newValue);
            if (selectedTenant) {
                form.tenant_id = selectedTenant.id;
            }
        }
    }
);

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="Criar uma conta" description="Insira seus dados abaixo para criar sua conta">
        <Head title="Cadastro" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Nome</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        v-model="form.name"
                        placeholder="Nome completo"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="email@exemplo.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="cpf">CPF</Label>
                    <Input id="cpf" type="text" required :tabindex="2" autocomplete="cpf" v-model="form.cpf" placeholder="000.000.000-00" v-maska="'###.###.###-##'" />
                    <InputError :message="form.errors.cpf" />
                </div>

                <div class="grid gap-2">
                    <Select v-model="form.professional_type" name="professional_type" :class="{ 'border-red-500': form.errors.professional_type }">
                        <SelectTrigger>
                            <SelectValue placeholder="Profissional" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="type in userTypes" :key="type.id" :value="type.code">
                                    {{ type.type }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.professional_type" class="text-sm text-red-500">
                        {{ form.errors.professional_type }}
                    </p>
                </div>

                <div v-if="showDocumentField" class="grid gap-2">
                    <Label for="document">Número de Registro</Label>
                    <Input
                        id="document"
                        v-model="form.document"
                        :placeholder="form.professional_type === 'other' ? 'Documento' : '000000-A'"
                        :required="documentRules.required"
                        :pattern="documentRules.pattern?.source"
                    />
                    <InputError :message="form.errors.document" />
                </div>

                <div class="grid gap-2">
                    <Label for="phone">Telefone</Label>
                    <Input id="phone" type="text" required :tabindex="2" autocomplete="phone" v-model="form.phone" placeholder="(00) 0 0000 0000" v-maska="'(##) # ####-####'"/>
                    <InputError :message="form.errors.phone" />
                </div>

                <div class="grid gap-2">
                    <Label for="address">Endereço</Label>
                    <Input
                        id="address"
                        type="text"
                        required
                        :tabindex="2"
                        autocomplete="address"
                        v-model="form.address"
                        placeholder="Avenida, 000, Bairro"
                    />
                    <InputError :message="form.errors.address" />
                </div>

                <div class="grid gap-2">
                    <Select v-model="form.city" name="city" :class="{ 'border-red-500': form.errors.city }">
                        <SelectTrigger>
                            <SelectValue placeholder="Cidade" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="tenant in tenants" :key="tenant.id" :value="tenant.name.toLowerCase()">
                                    {{ tenant.name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <p v-if="form.errors.city" class="text-sm text-red-500">
                        {{ form.errors.city }}
                    </p>
                </div>

                <div class="grid gap-2">
                    <Label for="password">Senha</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Sua senha"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirme a senha</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Digite novamente a senha"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit"  class="mt-2 w-full hover:bg-teal-900" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Criar conta
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Já tem uma conta?
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Entrar</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
