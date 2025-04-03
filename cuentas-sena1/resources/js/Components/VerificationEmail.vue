<script setup>
import { defineProps } from 'vue';

// Define las propiedades que el componente recibirá
const props = defineProps({
    verificationUrl: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="email-content">
        <p><strong>Asunto:</strong> Verifica tu correo electrónico</p>
        <p>¡Hola!</p>
        <p>Gracias por registrarte. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.</p>
        <a :href="verificationUrl" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Verificar mi cuenta
        </a>
        <p>Si no creaste una cuenta, puedes ignorar este correo.</p>
        <p>Saludos, {{ $page.props.appName || 'Tu Aplicación' }}</p>
    </div>
</template>

<style scoped>
.email-content {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}
</style>