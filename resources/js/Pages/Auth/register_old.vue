integrar este template:
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
        <Head title="Register" />

        <!-- Formulario de registro -->
        <form @submit.prevent="submit">
            <!-- Campo de Nombre -->
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Campo de Correo Electrónico -->
            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Campo de Contraseña -->
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Campo de Confirmación de Contraseña -->
            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <!-- Sección de Acciones -->
            <div class="mt-4 flex items-center justify-end">
                <!-- Enlace para iniciar sesión si ya está registrado -->
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <!-- Botón de Registro -->
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

