<template>
  <v-app>
    <v-main>
      <v-container>
          <div :class="{ 'dark bg-gray-900 text-white': isDarkMode }" class="p-4 min-h-screen transition-colors">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-semibold">Asignación de Materias a Instructores</h2>
              <v-btn :to="{ name: 'Disponibilidad' }">Disponibilidad</v-btn>
              <button @click="toggleDarkMode" class="px-4 py-2 border rounded-lg shadow">
                {{ isDarkMode ? 'Modo Claro' : 'Modo Oscuro' }}
              </button>
            </div>

            <!-- Lista de docentes -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
              <table class="w-full border-collapse">
                <thead>
                  <tr class="bg-gray-200 dark:bg-gray-700">
                    <th class="p-2 text-left">Docente</th>
                    <th class="p-2 text-left">Materia Asignada</th>
                    <th class="p-2">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="docente in docentes" :key="docente.id" class="border-b dark:border-gray-700">
                    <td class="p-2">{{ docente.nombre }}</td>
                    <td class="p-2">{{ docente.materia || 'No asignada' }}</td>
                    <td class="p-2 text-center">
                      <button @click="abrirModal(docente)" class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow">
                        Asignar
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        
            <!-- Modal de asignación -->
            <div v-if="mostrarModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
              <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-4">Asignar Materia a {{ docenteSeleccionado?.nombre }}</h3>
                <select v-model="materiaSeleccionada" class="w-full p-2 border rounded-lg">
                  <option disabled value="">Selecciona una materia</option>
                  <option v-for="materia in materias" :key="materia" :value="materia">{{ materia }}</option>
                </select>
                <div class="flex justify-end mt-4">
                  <button @click="cerrarModal" class="px-4 py-2 mr-2 border rounded-lg">Cancelar</button>
                  <button @click="asignarMateria" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow">Asignar</button>
                </div>
              </div>
            </div>
          </div>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script>
  export default {
    name: "AsignacionTransversal",
    data() {
      return {
        isDarkMode: localStorage.getItem("darkMode") === "true",
        mostrarModal: false,
        docenteSeleccionado: null,
        materiaSeleccionada: "",
        docentes: [
          { id: 1, nombre: "Juan Pérez", materia: "" },
          { id: 2, nombre: "María López", materia: "Física" },
          { id: 3, nombre: "Carlos Sánchez", materia: "" },
        ],
        materias: ["Matemáticas", "Física", "Química", "Historia", "Biología"],
      };
    },
    methods: {
      toggleDarkMode() {
        this.isDarkMode = !this.isDarkMode;
        localStorage.setItem("darkMode", this.isDarkMode);
      },
      abrirModal(docente) {
        this.docenteSeleccionado = docente;
        this.materiaSeleccionada = docente.materia || "";
        this.mostrarModal = true;
      },
      cerrarModal() {
        this.mostrarModal = false;
        this.docenteSeleccionado = null;
        this.materiaSeleccionada = "";
      },
      asignarMateria() {
        if (this.materiaSeleccionada && this.docenteSeleccionado) {
          this.docenteSeleccionado.materia = this.materiaSeleccionada;
          this.cerrarModal();
        }
      },
    },
  };
  </script>
  
  <style>
  /* Modo oscuro para el modal */
  .dark .modal {
    background-color: #1f2937;
    color: white;
  }
  </style>
  