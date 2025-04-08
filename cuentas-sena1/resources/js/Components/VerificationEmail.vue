<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    verificationUrl: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="email-content">
        <img src="/img/logo-sena.png" alt="Logo SENA" style="max-width: 150px; margin-bottom: 20px;">
        <p><strong>Asunto:</strong> Verifica tu correo electrónico</p>
        <p>¡Hola!</p>
        <p>Gracias por registrarte. Por favor, haz clic en el botón de abajo para verificar tu dirección de correo
            electrónico.</p>
        <a :href="verificationUrl" class="button">Verificar mi cuenta</a>
        <p>Si no creaste una cuenta, puedes ignorar este correo.</p>
        <p>Saludos, {{ $page.props.appName || 'Tu Aplicación' }}</p>
    </div>
</template>

<style scoped>
.email-content {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    text-align: center;
}

.email-content .button {
    background-color: #39A900;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
}

.email-content .button:hover {
    background-color: #007832;
    /* Color al pasar el mouse */
}
</style>