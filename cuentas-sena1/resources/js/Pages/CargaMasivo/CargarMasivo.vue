<template>
  <Dashboard>
    <!-- Contenido específico de CargarMasivo -->
    <h2 class="mb-4 text-lg font-semibold text-center">Cargar Masivo</h2>

    <!-- Formulario principal -->
    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-100 rounded-lg shadow-md">
      <!-- Columna izquierda -->
      <div>
        <!-- Campo Docente -->
        <div class="mb-4">
          <label for="docente" class="block mb-2 font-semibold">DOCENTE</label>
          <input
            type="text"
            id="docente"
            v-model="docente"
            placeholder="Nombre del docente"
            class="w-full px-4 py-2 border border-gray-300 rounded-md"
          />
        </div>

        <!-- Campo Mes y Fecha en cuadro -->
        <div class="flex items-center justify-between mb-4">
          <!-- Campo Mes -->
          <div class="w-1/2 pr-2">
            <label for="mes" class="block mb-2 font-semibold">Mes</label>
            <input
              type="text"
              id="mes"
              v-model="mes"
              placeholder="Mes"
              class="w-full px-4 py-2 border border-gray-300 rounded-md"
            />
          </div>

          <!-- Campo Fecha -->
          <div class="w-1/2 pl-2">
            <label for="fecha" class="block mb-2 font-semibold">Fecha</label>
            <input
              type="date"
              id="fecha"
              v-model="fecha"
              class="w-full px-4 py-2 border border-gray-300 rounded-md"
            />
          </div>
        </div>
      </div>

      <!-- Columna derecha -->
      <div>
        <!-- Selección de documentos GC -->
        <div>
          <label for="fileInput2" class="block mb-2 font-semibold">Seleccione documentos GC:</label>
          <input
            type="file"
            id="fileInput2"
            name="fileInput2"
            multiple
            accept="application/pdf"
            @change="onFileChange2"
            class="block w-full px-4 py-2 mb-2 border border-gray-300 rounded-md"
          />
          <ul class="list-disc list-inside">
            <li v-for="(file, index) in selectedFiles2" :key="index" class="text-sm">
              {{ file.name }}
            </li>
          </ul>
        </div>

        <!-- Botón Unir PDF para GC -->
        <div class="flex justify-center mt-4">
          <button
            @click="mergePDFs2"
            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600"
          >
            Unir PDF
          </button>
        </div>

        <!-- Selección de documentos GF (movido aquí) -->
        <div class="mt-6">
          <label for="fileInput1" class="block mb-2 font-semibold">Seleccione documentos GF:</label>
          <input
            type="file"
            id="fileInput1"
            name="fileInput1"
            multiple
            accept="application/pdf"
            @change="onFileChange1"
            class="block w-full px-4 py-2 mb-2 border border-gray-300 rounded-md"
          />
          <ul class="list-disc list-inside">
            <li v-for="(file, index) in selectedFiles1" :key="index" class="text-sm">
              {{ file.name }}
            </li>
          </ul>
        </div>

        <!-- Botón Unir PDF para GF -->
        <div class="flex justify-center mt-4">
          <button
            @click="mergePDFs1"
            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600"
          >
            Unir PDF
          </button>
        </div>
      </div>
    </div>

    <!-- Botón de envío -->
    <div class="flex justify-center mt-6">
      <button
        @click="handleSubmit"
        class="px-6 py-2 text-white bg-green-500 rounded-md hover:bg-green-600"
      >
        Enviar
      </button>
    </div>
  </Dashboard>
</template>

<script setup>
import { ref } from 'vue';
import Dashboard from '@/Pages/Dashboard.vue'; // Importar el componente Dashboard

// Variables de estado
const docente = ref('');
const mes = ref('');
const fecha = ref('');
const selectedFiles1 = ref([]);
const selectedFiles2 = ref([]);

// Métodos para manejar archivos
const onFileChange1 = (event) => {
  const files = Array.from(event.target.files);
  selectedFiles1.value = files;
};

const onFileChange2 = (event) => {
  const files = Array.from(event.target.files);
  selectedFiles2.value = files;
};

// Métodos para unir PDFs
const mergePDFs1 = () => {
  if (!selectedFiles1.value.length) {
    alert('Por favor selecciona archivos para unir.');
    return;
  }
  alert('Archivos GF unidos correctamente.');
  console.log('Archivos GF para unir:', selectedFiles1.value);
};

const mergePDFs2 = () => {
  if (!selectedFiles2.value.length) {
    alert('Por favor selecciona archivos para unir.');
    return;
  }
  alert('Archivos GC unidos correctamente.');
  console.log('Archivos GC para unir:', selectedFiles2.value);
};

// Método para manejar el envío
const handleSubmit = () => {
  if (!docente.value || !mes.value || !fecha.value) {
    alert('Por favor completa todos los campos.');
    return;
  }
  if (!selectedFiles1.value.length || !selectedFiles2.value.length) {
    alert('Por favor selecciona los archivos requeridos.');
    return;
  }
  alert('Formulario enviado correctamente.');
  console.log({
    docente: docente.value,
    mes: mes.value,
    fecha: fecha.value,
    archivosGF: selectedFiles1.value,
    archivosGC: selectedFiles2.value,
  });
};
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
}
</style>