<script setup>
// Importación de componentes reutilizables y utilidades de Inertia.js
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

// Creación del formulario con Inertia.js
// Solo se requiere el campo de contraseña para confirmar la identidad del usuario
const form = useForm({
    password: '',
});

// Función que envía la solicitud de confirmación de contraseña al backend
const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(), // Limpia el formulario al finalizar la solicitud
    });
};
</script>   

<template>
    <GuestLayout>
        <!-- Título de la página -->
        <Head title="Confirm Password" />

        <!-- Mensaje de instrucción para el usuario -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <!-- Formulario de confirmación de contraseña -->
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Botón para confirmar la contraseña -->
            <div class="mt-4 flex justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
