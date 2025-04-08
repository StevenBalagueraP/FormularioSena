<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="flex flex-col w-64 p-4 bg-gray-100 shadow-xl">
      <!-- Logo -->
      <div class="flex justify-center mb-3">
        <img src="/img/logo-sena.png" alt="Logo SENA" 
          class="border border-gray-300 rounded-full "
          style="height: 150px;width:150px; box-shadow: 4px 4px 8px rgba(0,0,0,0.1), -4px -4px 8px rgba(255,255,255,0.5); border-radius: 50%;"
        />
      </div>
      <div class="flex flex-col items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Bienvenido, usuario:</h2>
        <!-- Nombre y Apellido del Usuario -->
        <span class="text-lg font-bold text-gray">{{$page.props.auth.user.nombre}}</span>
        <span class="text-lg font-bold text-gray">{{$page.props.auth.user.apellido}}</span>
      </div>

      <hr class="my-4 border-gray-300" />

      <!-- Menu -->
      <nav class="flex-1">
        <ul class="space-y-2">
          <li v-for="item in menuItems" :key="item.name" 
            class="flex items-center p-2 transition duration-200 bg-gray-200 rounded-lg cursor-pointer hover:bg-primary hover:text-white">
            <component :is="item.icon" class="w-5 h-5 mr-2" />
            <span>{{ item.name }}</span>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-col flex-1">
      <!-- Header -->
      <header class="flex items-center justify-between p-4 bg-white shadow-md">
        <h1 class="text-xl font-semibold">Programa Reporte de Cuentas</h1>
        <div class="flex items-center space-x-4">
          <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">🔔</button>
          <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">❓</button>
       
          <!-- Icono de Cerrar Sesión -->
          <div class="flex justify-end p-4 text-white bg-primary rounded-s">
            <button 
              @click="logout"
              class="text-xs text-white transition hover:text-yellow-400"
            >
              Cerrar sesión
            </button>
          </div>
        </div>
      </header>

      <!-- CRUD Table -->
      <main class="p-6">
        <h2 class="mb-4 text-lg font-semibold">Cargar Masivo</h2>
        <div class="grid grid-cols-2 gap-4">
          <!-- Primera columna -->
          <div>
            <form @submit.prevent="handleFileUpload1">
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
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Home, User, File, FolderPlus, ClipboardList } from 'lucide-vue-next';
import Textinput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';

const logout = () => {
  router.post(route('logout'));
};

const menuItems = ref([
  { name: 'Inicio', icon: Home },
  { name: 'Perfil', icon: User },
  { name: 'Usuarios', icon: User },
  { name: 'Crear Programa', icon: FolderPlus },
  { name: 'Crear Proyecto', icon: FolderPlus },
  { name: 'Registro Competencias y RA', icon: ClipboardList },
  { name: 'Crear Ficha', icon: File },
  { name: 'Asignación Titular Ficha', icon: User },
  { name: 'Asignación Transversales', icon: User },
  { name: 'Reporte Horas', icon: File },
  { name: 'Crear Filtros', icon: FolderPlus },
  { name: 'Reportes', icon: File },
  { name: 'Cargue Masivo', icon: ClipboardList }
]);

// Primera columna
const selectedFiles1 = ref([]);
const errorMessage1 = ref('');

const onFileChange1 = (event) => {
  const newFiles = Array.from(event.target.files);
  const invalidFiles = newFiles.filter(file => file.type !== 'application/pdf');

  if (invalidFiles.length > 0) {
    errorMessage1.value = 'Solo se permiten archivos PDF.';
    return;
  }

  selectedFiles1.value = [...selectedFiles1.value, ...newFiles];
  errorMessage1.value = '';
};

const handleFileUpload1 = () => {
  if (selectedFiles1.value.length === 0) {
    errorMessage1.value = 'Por favor selecciona al menos un archivo.';
    return;
  }
  console.log('Archivos para subir (Columna 1):', selectedFiles1.value);
  alert('Archivos subidos correctamente (Columna 1).');
};

// Segunda columna
const selectedFiles2 = ref([]);
const errorMessage2 = ref('');

const onFileChange2 = (event) => {
  const newFiles = Array.from(event.target.files);
  const invalidFiles = newFiles.filter(file => file.type !== 'application/pdf');

  if (invalidFiles.length > 0) {
    errorMessage2.value = 'Solo se permiten archivos PDF.';
    return;
  }

  selectedFiles2.value = [...selectedFiles2.value, ...newFiles];
  errorMessage2.value = '';
};

const handleFileUpload2 = () => {
  if (selectedFiles2.value.length === 0) {
    errorMessage2.value = 'Por favor selecciona al menos un archivo.';
    return;
  }
  console.log('Archivos para subir (Columna 2):', selectedFiles2.value);
  alert('Archivos subidos correctamente (Columna 2).');
};
</script>

<style>
body {
font-family: 'Arial', sans-serif;
}
</style>