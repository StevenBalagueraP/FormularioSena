<template>
    <Dashboard>
      <div>
        <CreateFile />
      </div>
  
      <DataTable :data="files" :columns="columns" :customcomponent="FileEdit"/>
    </Dashboard>
  </template>
  
  <script setup>
  import Dashboard from '@/Pages/Dashboard.vue';
  import DataTable from '@/ComponentesNew/DataTableNew.vue';
   import { ref } from 'vue';
  import FileEdit from './Edit.vue';
  import CreateFile from './Create.vue';
 
// Removed unused setShow function
// Removed unused close function

  
  // Columnas de la tabla (alias: lo que se muestra en la cabecera, datacol: propiedad del objeto)
  const columns = ref([
    { alias: 'ID', datacol: 'id' },
    { alias: 'Número de ficha', datacol: 'numero_ficha' },
    { alias: 'Instructor líder', datacol: 'instructor_lider' },
    { alias: 'Jornada', datacol: 'jornada' },
    { alias: 'Horario', datacol: 'horario' },
    { alias: 'Ambiente', datacol: 'ambiente' },
    { alias: 'Días de formación', datacol: 'dias_formacion' },
     ])
  
  // Recibe los datos desde el controlador de Laravel
  defineProps({
    files: Array
  })
  </script>
  