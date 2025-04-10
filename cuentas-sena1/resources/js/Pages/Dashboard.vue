<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-100 shadow-xl p-4 flex flex-col">
      <!-- Logo -->
      <div class="flex justify-center mb-3">
        <img src="/img/logo-sena.png" alt="Logo SENA" 
          class="rounded-full border border-gray-300 "
          style="height: 150px;width:150px; box-shadow: 4px 4px 8px rgba(0,0,0,0.1), -4px -4px 8px rgba(255,255,255,0.5); border-radius: 50%;"
        />
      </div>
      <div class="flex flex-col items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Bienvenido, usuario:</h2>
         Nombre y Apellido del Usuario
           <span class="text-gray text-lg font-bold">{{$page.props.auth.user.nombre}}</span>
          <span class="text-gray text-lg font-bold">{{$page.props.auth.user.apellido}}</span> 

      </div>

      <hr class="border-gray-300 my-4" />

      <!-- Menu -->
      <nav class="flex-1">
        <ul class="space-y-2">
          <li v-for="item in menuItems" :key="item.name" 
            class="flex items-center p-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-primary hover:text-white transition duration-200">
            <component :is="item.icon" class="w-5 h-5 mr-2" />
            <span>{{ item.name }}</span>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Programa Reporte de Cuentas</h1>
        <div class="flex items-center space-x-4">
          <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">🔔</button>
          <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">❓</button>
       
          <!-- Icono de Cerrar Sesión -->
          <div class="flex justify-end p-4 bg-primary text-white rounded-s">
            <button 
      @click="logout"
      class="text-white text-xs hover:text-yellow-400 transition"
    >
      Cerrar sesión
    </button>

  </div>
        </div>
      </header>

      <!-- CRUD Table -->
      <main class="p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Home, User, File, FolderPlus, ClipboardList } from 'lucide-vue-next';

import { router } from '@inertiajs/vue3'

const logout = () => {
  router.post(route('logout'))
}
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



const data = ref([
  { id: 1, name: 'Ejemplo 1' },
  { id: 2, name: 'Ejemplo 2' },
  { id: 3, name: 'Ejemplo 3' }
]);


</script>

<style>
body {
  font-family: 'Arial', sans-serif;
}
</style>