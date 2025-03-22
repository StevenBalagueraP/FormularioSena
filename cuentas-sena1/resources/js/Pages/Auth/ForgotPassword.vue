<script setup>
// Importación de componentes y utilidades necesarias
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

// Definición de propiedades recibidas del padre
// "status" muestra un mensaje informativo al usuario
defineProps({
    status: {
        type: String,
    },
});

// Creación del formulario utilizando Inertia.js
// Contiene un único campo para el email
const form = useForm({
    email: '',
});

// Función que envía la solicitud para restablecer la contraseña
const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <!-- Título de la página -->
        <Head title="Forgot Password" />

        <!-- Mensaje informativo para el usuario -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <!-- Mensaje de estado si existe -->
        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <!-- Formulario para solicitar el restablecimiento de contraseña -->
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <!-- Mensaje de error si el email es inválido -->
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Botón para enviar la solicitud -->
            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
