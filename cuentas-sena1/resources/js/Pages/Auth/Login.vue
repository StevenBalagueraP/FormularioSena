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
defineProps({
    canResetPassword: Boolean,
    status: String,
});

// Creación del formulario con Inertia.js
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// Función que envía el formulario al backend
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
              <!-- Título de la página -->
        <Head title="Iniciar Sesión" />
        
        <div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
            
            <div class="card p-4 shadow-lg rounded-lg text-center" style="width: 100%; max-width: 500px;">
                
                <!-- Logo -->
                <div class="text-center mb-3">
                    <img src="/img/logo-sena.png" alt="Logo SENA" class="img-fluid rounded-circle mx-auto" style="width: 100px;">
                </div>
                <h1 class="text-center mb-4 text-success text-[30px] font-bold">Iniciar Sesión</h1>
                

                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <InputLabel for="email" value="Correo" />
                        <TextInput id="email" type="email" class="form-control" v-model="form.email" required />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    
                    <div class="mb-3">
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput id="password" type="password" class="form-control" v-model="form.password" required />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    
                    <div class="mb-3 form-check">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <label class="form-check-label ms-2">Recordarme</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-decoration-none hover:text-dark hover:text-green-950 hover:underline">¿Olvidaste tu contraseña?</Link>
                        <PrimaryButton class="btn-custom mt-3">Iniciar Sesión</PrimaryButton>
                    </div>
                </form>
                
                <p class="text-center mt-3">
                    ¿No tienes cuenta? <Link href="/register" class="text-decoration-none hover:text-dark hover:underline hover:text-green-950">Regístrate</Link>
                </p>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
.btn-custom {
    background-color: #39a900;
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
}

.btn-custom:hover {
    background-color: #007832;
}
</style>