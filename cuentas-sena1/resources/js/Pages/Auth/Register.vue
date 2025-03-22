<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    id: '',
    usuario: '',
    nombre: '',
    apellido: '',
    email: '',
    telefono: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <!-- Título de la página -->
        <Head title="Registro" />

        <div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
            <div class="card p-4 shadow-lg rounded-lg text-center" style="width: 100%; max-width: 500px;">
                
                <!-- Logo -->
                <div class="text-center mb-3">
                    <img src="/img/logo-sena.jpg" alt="Logo SENA" class="img-fluid rounded-circle mx-auto" style="width: 100px;">
                </div>

                <h1 class="text-center mb-4 text-success text-[30px] font-bold">Registro</h1>

                <!-- Formulario de registro -->
                <form @submit.prevent="submit">
                    
                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="nombre" 
                            type="text" 
                            class="mt-1 block w-full" 
                            placeholder="Nombre" 
                            v-model="form.nombre" 
                            required 
                            autofocus
                            autocomplete="nombre" />
                    </div>
                    <InputError :message="form.errors.nombre" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="apellido" 
                            type="text" 
                            class="mt-1 block w-full" 
                            placeholder="Apellido" 
                            v-model="form.apellido" 
                            required
                            autocomplete="apellido" />
                    </div>
                    <InputError :message="form.errors.apellido" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="usuario" 
                            type="text" 
                            class="mt-1 block w-full" 
                            placeholder="Usuario" 
                            v-model="form.usuario" 
                            required
                            autocomplete="usuario" />
                    </div>
                    <InputError :message="form.errors.usuario" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="telefono" 
                            type="tel" 
                            class="mt-1 block w-full" 
                            placeholder="Teléfono" 
                            v-model="form.telefono" 
                            required
                            autocomplete="telefono" />
                    </div>
                    <InputError :message="form.errors.telefono" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="email" 
                            type="email" 
                            class="mt-1 block w-full" 
                            placeholder="Correo Electrónico" 
                            v-model="form.email" 
                            required 
                            autocomplete="email"/>
                    </div>
                    <InputError :message="form.errors.email" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="password" 
                            type="password" 
                            class="mt-1 block w-full" 
                            placeholder="Contraseña" 
                            v-model="form.password" 
                            required
                            autocomplete="new-password" />
                    </div>
                    <InputError :message="form.errors.password" />

                    <div class="mb-3 d-flex justify-content-center">
                        <TextInput  
                            id="password_confirmation" 
                            type="password" 
                            class="mt-1 block w-full" 
                            placeholder="Confirmar Contraseña" 
                            v-model="form.password_confirmation" 
                            required
                            autocomplete="new-password" />
                    </div>
                    <InputError :message="form.errors.password_confirmation" />

                    <!-- Sección de Acciones -->
                    <div class="text-center mt-3">
                        <p class="mb-2">
                            ¿Ya tienes cuenta?  
                            <Link
    :href="route('login')"
    class="text-success text-decoration-none fw-bold hover:text-dark hover:underline"
>
    Inicia sesión
</Link>
                        </p>

                        <!-- Botón de Registro -->
                        <PrimaryButton
                            class="btn btn-success w-75"
                            :class="{ 'opacity-50': form.processing }"
                            :disabled="form.processing"
                        >
                            Registrarse
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

