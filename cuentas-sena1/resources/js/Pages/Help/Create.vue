<template>
     <div class="container px-5">
        <button @click="setShow" class="bg-primary text-white">
            <span class="icon">+</span> Add Help
        </button>
    </div>
    <Teleport to="body">

    <div>
   
        <TextInput  
            id="nombre" 
            type="text" 
            class="mt-1 block w-full" 
            placeholder="Nombre" 
            v-model="form.nombre" 
            required 
            autofocus
            autocomplete="nombre" 
        />
        <InputError :message="form.errors.nombre" />
    </div>
<!-- </Modal> -->

</Teleport>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';  
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';      


const form = useForm({
    nombre: '' // Asegurar que `nombre` existe desde el inicio
});
</script>
