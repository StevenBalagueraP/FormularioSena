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
    verificationUrl: {
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

// URL de ejemplo para la vista previa (puedes obtenerla dinámicamente si la pasas como prop)
const verificationUrl = computed(() => 'https://example.com/verify-email?token=abc123');
</script>


<template>
    <GuestLayout>
        <!-- Configura el título de la pestaña -->
        <div class="text-center mb-3">
            <img src="/img/logo-sena.png" alt="Logo SENA" class="img-fluid rounded-circle mx-auto"
                style="width: 100px;">
        </div>

        <h1 class="text-center mb-4 text-success text-[30px] font-bold">Registro</h1>

        <Head title="Email Verification" />

        <!-- Mensaje de instrucciones para verificar el correo -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo
            clic en el enlace que te acabamos de enviar? Si no recibiste el correo, con gusto te enviaremos otro.
        </div>

        <!-- Mensaje de confirmación si el enlace fue reenviado correctamente -->
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400" v-if="verificationLinkSent">
            Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste
            durante el registro
        </div>

        <!-- Formulario para reenviar el correo de verificación -->
        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">

                <!-- Botón para reenviar el correo -->
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reenviar correo de verificación
                </PrimaryButton>

                <!-- Enlace para cerrar sesión -->
                <Link :href="route('logout')" method="post" as="button"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
                Cerrar sesión</Link>
            </div>
        </form>

    </GuestLayout>
</template>

