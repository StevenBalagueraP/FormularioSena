<template>
    <Dashboard>
      <!-- Contenido específico de CargarMasivo -->
      <h2 class="mb-4 text-lg font-semibold">Cargar Masivo</h2>
      <div class="grid grid-cols-2 gap-4">
        <!-- Primera columna -->
        <div>
          <form @submit.prevent="handleFileUpload1">
            <Textinput />
            <label for="fileInput1" class="block mb-2">Seleccione documentos GF:</label>
            <input
              type="file"
              id="fileInput1"
              name="fileInput1"
              multiple
              accept="application/pdf"
              @change="onFileChange1"
              class="block w-full p-2 border border-gray-300 rounded"
            />
            <p v-if="errorMessage1" class="mt-2 text-sm text-red-500">{{ errorMessage1 }}</p>
            <button
              type="submit"
              class="px-4 py-2 mt-4 text-white bg-green-500 rounded hover:bg-primary"
            >
              Subir Archivos
            </button>
          </form>
  
          <!-- Mostrar archivos seleccionados -->
          <div v-if="selectedFiles1.length > 0" class="mt-4">
            <h3 class="text-lg font-semibold">Archivos seleccionados (Columna 1):</h3>
            <ul class="list-disc list-inside">
              <li v-for="(file, index) in selectedFiles1" :key="index">
                {{ file.name }}
              </li>
            </ul>
          </div>
        </div>
  
        <!-- Segunda columna -->
        <div>
          <form @submit.prevent="handleFileUpload2">
            <label for="fileInput2" class="block mb-2">Seleccione documentos GC:</label>
            <input
              type="file"
              id="fileInput2"
              name="fileInput2"
              multiple
              accept="application/pdf"
              @change="onFileChange2"
              class="block w-full p-2 border border-gray-300 rounded"
            />
            <p v-if="errorMessage2" class="mt-2 text-sm text-red-500">{{ errorMessage2 }}</p>
            <button
              type="submit"
              class="px-4 py-2 mt-4 text-white bg-green-500 rounded hover:bg-primary"
            >
              Subir Archivos
            </button>
          </form>
  
          <!-- Mostrar archivos seleccionados -->
          <div v-if="selectedFiles2.length > 0" class="mt-4">
            <h3 class="text-lg font-semibold">Archivos seleccionados (Columna 2):</h3>
            <ul class="list-disc list-inside">
              <li v-for="(file, index) in selectedFiles2" :key="index">
                {{ file.name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
  
      <!-- Tabla de datos -->
      <div class="p-4 overflow-hidden bg-white rounded-lg shadow">
        <div class="w-full mt-4 overflow-x-auto">
          <div class="max-w-full min-w-full md:w-full lg:w-full">
            <DataTableNew :data="tableData" :columns="columns" :customcomponent="customComponent"
              class="w-full text-xs table-auto md:text-sm" />
          </div>
        </div>
      </div>
    </Dashboard>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import Dashboard from '@/Pages/Dashboard.vue'; // Importar el componente Dashboard
  import DataTableNew from '@/ComponentesNew/DataTableNew.vue';
  
  const menuItems = ref([
    { name: 'Inicio', icon: 'Home' },
    { name: 'Cargue Masivo', icon: 'ClipboardList' },
  ]);
  
  // Datos para la tabla
  const tableData = ref([
    { id: 1, name: 'Biviana Ortegon', email: 'usuario1@example.com', role: 'Admin', month: 'Enero' },
    { id: 2, name: 'Elias Martinez', email: 'usuario2@example.com', role: 'Editor', month: 'Febrero' },
  ]);
  
  const columns = ref([
    { alias: 'ID', datacol: 'id' },
    { alias: 'Usuario', datacol: 'name' },
    { alias: 'Correo', datacol: 'email' },
    { alias: 'Rol', datacol: 'role' },
    { alias: 'Mes', datacol: 'month' },
  ]);
  
  const customComponent = ref({
    actions: {
      edit: (row) => console.log('Editar:', row),
      delete: (row) => console.log('Eliminar:', row),
    },
  });
  
  // Manejo de archivos
  const selectedFiles1 = ref([]);
  const errorMessage1 = ref('');
  const onFileChange1 = (event) => {
    const files = Array.from(event.target.files);
    selectedFiles1.value = files;
  };
  
  const handleFileUpload1 = () => {
    if (!selectedFiles1.value.length) {
      errorMessage1.value = 'Por favor selecciona al menos un archivo.';
      return;
    }
    alert('Archivos GF subidos correctamente.');
    console.log('Archivos GF:', selectedFiles1.value);
  };
  
  const selectedFiles2 = ref([]);
  const errorMessage2 = ref('');
  const onFileChange2 = (event) => {
    const files = Array.from(event.target.files);
    selectedFiles2.value = files;
  };
  
  const handleFileUpload2 = () => {
    if (!selectedFiles2.value.length) {
      errorMessage2.value = 'Por favor selecciona al menos un archivo.';
      return;
    }
    alert('Archivos GC subidos correctamente.');
    console.log('Archivos GC:', selectedFiles2.value);
  };
  </script>
  
  <style>
  body {
    font-family: 'Arial', sans-serif;
  }
  </style>