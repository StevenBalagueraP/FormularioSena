<template>
    <Dashboard>
      <div>
        <Create />
      </div>
  
      <DataTable
        :data="files" 
        :columns="columns" 
        :customcomponent="FileEdit"
      
      />
    </Dashboard>
  </template>
  
  <script setup>
  import Dashboard from '@/Pages/Dashboard.vue'
  import DataTable from '@/ComponentesNew/DataTableNew.vue'
  import Create from './Create.vue'
   import { ref } from 'vue'
  import FileEdit from './Edit.vue'
 
  const show = ref(false);
const setShow = () => show.value = true;
const close = () => show.value = false;

  
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
  const props = defineProps({
    files: Array
  })
  </script>
  