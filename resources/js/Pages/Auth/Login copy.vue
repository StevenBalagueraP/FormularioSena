<script setup>
// Importación de componentes reutilizables
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Definición de propiedades recibidas por el componente
// - canResetPassword: Indica si se permite la opción de restablecer la contraseña
// - status: Mensaje de estado para mostrar al usuario
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

// Creación del formulario con Inertia.js
// Se definen los campos: email, password y remember (para recordar sesión)
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// Función que envía el formulario al backend para autenticar al usuario
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'), // Resetea la contraseña después de enviar el formulario
    });
};
</script>

<template>
    <GuestLayout>
        <!-- Título de la página -->
        <Head title="Log in" />

        <!-- Mensaje de estado si está presente -->
        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <!-- Formulario de inicio de sesión -->
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

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Checkbox para recordar sesión -->
            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
            </div>

            <!-- Opciones adicionales -->
            <div class="mt-4 flex items-center justify-end">
                <!-- Enlace para recuperar contraseña -->
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Forgot your password?
                </Link>

                <!-- Botón de inicio de sesión -->
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
<style scoped>
</style>