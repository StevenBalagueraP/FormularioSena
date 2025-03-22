<template>
    <div class="flex h-screen bg-gray-100">
      <!-- Sidebar -->
      <aside class="w-64 bg-gray-100 shadow-xl p-4 flex flex-col">
        <!-- Logo -->
        <div class="text-center mb-3">
          <img src="/img/logo-sena.png" alt="Logo SENA" 
            class="rounded-full mx-auto shadow-md border-2 border-gray-300"
            style="width: 100px; box-shadow: 4px 4px 8px rgba(0,0,0,0.1), -4px -4px 8px rgba(255,255,255,0.5);">
        </div>
  
        <hr class="border-gray-300 my-4" />
  
        <!-- Menu -->
        <nav class="flex-1">
          <ul class="space-y-2">
            <li v-for="item in menuItems" :key="item.name" 
    class="flex items-center p-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-primary  hover:text-white transition duration-200">

              <component :is="item.icon" class="w-5 h-5 mr-2" />
              <span>{{ item.name }}</span>
            </li>
          </ul>
        </nav>
        <!-- Botón de Cerrar Sesión -->
      <button 
        @click="logout"
        class="flex items-center justify-center p-2 bg-red-500 text-white rounded-lg cursor-pointer hover:bg-red-700 transition duration-200">
        <span class="mr-2">Cerrar Sesión</span> 🔴
      </button>
      </aside>
  
      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
          <h1 class="text-xl font-semibold">Programa Reporte de Cuentas</h1>
          <div class="flex items-center space-x-4">
            <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">🔔</button>
            <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">❓</button>
            <span class="font-medium">Usuario</span>
          </div>
        </header>
  
        <!-- CRUD Table -->
         <main class="p-6">
          <h2 class="text-lg font-semibold mb-4">Gestión de Datos</h2>
          <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-300 text-gray-700">
              <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in data" :key="item.id" class="border-b">
                <td class="p-2 text-center">{{ item.id }}</td>
                <td class="p-2 text-center">{{ item.name }}</td>
                <td class="p-2 text-center">
                  <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">Editar</button>
                  <button class="bg-red-500 text-white px-3 py-1 rounded ml-2 hover:bg-red-700">Eliminar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </main>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  import { Home, User, File, FolderPlus, ClipboardList } from 'lucide-vue-next';
  
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
  const logout = () => {
  alert('Sesión cerrada');
  // Aquí puedes agregar la lógica real para cerrar sesión, como redirigir a la página de login
};
  </script>
  
  <style>
  
    
  body {
    font-family: 'Arial', sans-serif;
  }
  
  /* Si usas Tailwind, asegúrate de tener bg-primary en tu configuración de colores */
  </style>
  