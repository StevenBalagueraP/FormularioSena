<template>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center py-10">
      <div class="w-full max-w-5xl">
        <div class="bg-white shadow-lg rounded-xl p-6 text-center">
          <header class="mb-6">
            <div class="flex justify-center">
              <img src="../../../../public/img/logo-sena.png" alt="banner" class="h-20">
            </div>
            <h1 class="text-3xl font-extrabold text-gray-700 mt-4">Programas Pagina Principal</h1>
          </header>
  
          <div class="flex flex-col items-center space-y-4">
            <div class="flex items-center space-x-3 w-full">
              <input 
                v-model="searchQuery"
                type="text" 
                placeholder="Ingrese un nombre..." 
                class="border border-gray-300 p-3 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
              />
              <datalist id="name-options">
                <option value="Análisis"></option>
                <option value="Ejecución"></option>
                <option value="Evaluación"></option>
                <option value="Planeación"></option>
              </datalist>
              <button 
                @click="search"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition duration-300">
                Buscar
              </button>
            </div>
          </div>
  
          <div class="flex flex-wrap justify-center gap-4 mt-6">
            <button @click="createProgram" class="btn-green">Crear Programa</button>
            <button @click="createFicha" class="btn-green">Crear Ficha</button>
            <button @click="createProject" class="btn-green">Crear Proyecto</button>
            <button @click="createCompetencia" class="btn-green">Crear Competencia</button>
          </div>
        </div>

        <div class="mt-8">
          <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-200 text-gray-700">
              <tr>
                <th class="border px-4 py-2">Número de Programa</th>
                <th class="border px-4 py-2">Nombre del Programa</th>
                <th class="border px-4 py-2">Competencias</th>
                <th class="border px-4 py-2">Resultados de Aprendizaje</th>
                <th class="border px-4 py-2">Instructor</th>
                <th class="border px-4 py-2">Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(program, index) in programs" :key="index" class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ program.id }}</td>
                <td class="border px-4 py-2">{{ program.name }}</td>
                <td class="border px-4 py-2">{{ program.competencias }}</td>
                <td class="border px-4 py-2">{{ program.resultados }}</td>
                <td class="border px-4 py-2">{{ program.instructor }}</td>
                <td class="border px-4 py-2 text-center">
                  <input type="checkbox" class="mr-2">
                  <button 
                    @click="editProgram(program.id)" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                    Editar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <footer class="mt-10 py-4 text-center text-gray-500 text-sm">
        <p>© 2025 Programas. Todos los derechos reservados.</p>
      </footer>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  
  export default {
    setup() {
      const searchQuery = ref("");
      const programs = ref([
        { id: "001", name: "Desarrollo de Software", competencias: "Programación", resultados: "Desarrolla aplicaciones", instructor: "Juan Pérez" },
        { id: "002", name: "Diseño Gráfico", competencias: "Creatividad", resultados: "Crea contenido visual", instructor: "María Gómez" },
      ]);
  
      const search = () => {
        alert("Buscando: " + searchQuery.value);
      };
  
      const createProgram = () => {
        alert("Crear Programa");
      };
  
      const createFicha = () => {
        alert("Crear Ficha");
      };
  
      const createProject = () => {
        alert("Crear Proyecto");
      };
  
      const createCompetencia = () => {
        alert("Crear Competencia");
      };
  
      const editProgram = (id) => {
        alert("Editando programa con ID: " + id);
      };
  
      return {
        searchQuery,
        programs,
        search,
        createProgram,
        createFicha,
        createProject,
        createCompetencia,
        editProgram
      };
    },
  };
  </script>
  
  <style scoped>
  .btn-green {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }
  
  .btn-green:hover {
    background-color: #218838;
  }
  </style>
  