<script setup>
import { computed } from 'vue'; // Importa la función computed de Vue para valores reactivos.
import GuestLayout from '@/Layouts/GuestLayout.vue'; // Importa el diseño de invitado.
import PrimaryButton from '@/Components/PrimaryButton.vue'; // Importa el botón principal.
import { Head, Link, useForm } from '@inertiajs/vue3'; // Importa funciones de Inertia.js para el manejo del formulario y navegación.

// Define las propiedades que el componente puede recibir.
const props = defineProps({
    status: {
        type: String,
    },
});

// Inicializa el formulario con Inertia.js sin datos iniciales.
const form = useForm({});

// Función para enviar la solicitud de reenvío del correo de verificación.
const submit = () => {
    form.post(route('verification.send'));
};

// Variable computada que verifica si el estado indica que se envió el enlace de verificación.
const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <!-- Configura el título de la pestaña -->
        <Head title="Email Verification" />

        <!-- Mensaje de instrucciones para verificar el correo -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Thanks for signing up! Before getting started, could you verify your
            email address by clicking on the link we just emailed to you? If you
            didn't receive the email, we will gladly send you another.
        </div>

        <!-- Mensaje de confirmación si el enlace fue reenviado correctamente -->
        <div
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to the email address you
            provided during registration.
        </div>

        <!-- Formulario para reenviar el correo de verificación -->
        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <!-- Botón para reenviar el correo -->
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Resend Verification Email
                </PrimaryButton>

                <!-- Enlace para cerrar sesión -->
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                    >Log Out</Link
                >
            </div>
        </form>
    </GuestLayout>
</template>