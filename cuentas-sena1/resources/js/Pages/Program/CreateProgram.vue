<template>
  <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Crear Programa</h1>

    <!-- Componente Index -->
    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">Listado de Ayuda</h2>
      <HelpIndex />
    </section>

    <!-- Componente Create -->
    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2">Agregar Ayuda</h2>
      <HelpCreate />
    </section>

    <!-- Componente Edit -->
    <section>
      <h2 class="text-xl font-semibold mb-2">Editar Ayuda</h2>
      <HelpEdit />
    </section>
  </div>
</template>

<script setup>
// Importar los componentes desde la carpeta Help
import HelpIndex from '@/Pages/Help/Index.vue';
import HelpCreate from '@/Pages/Help/Create.vue';
import HelpEdit from '@/Pages/Help/Edit.vue';
</script>

<style>
/* Agrega estilos personalizados si es necesario */
</style>
