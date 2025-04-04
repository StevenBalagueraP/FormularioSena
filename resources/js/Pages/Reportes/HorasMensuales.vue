<template>
    <v-app>
      <v-main>
        <v-container>
          <h1 class="text-2xl font-bold mb-4">Resumen Mensual de Horas Laboradas</h1>
  
          <!-- Filtros -->
          <div class="flex flex-col md:flex-row gap-4 mb-4">
            <v-text-field
              v-model="filtroDocente"
              label="Buscar por docente"
              clearable
              prepend-icon="mdi-account"
            />
  
            <v-select
              v-model="filtroMes"
              :items="meses"
              label="Filtrar por mes"
              clearable
              prepend-icon="mdi-calendar"
            />
          </div>
  
          <!-- Tabla -->
          <v-data-table
            :headers="headers"
            :items="filtrados"
            class="elevation-1"
          >
            <template v-slot:item.totalHoras="{ item }">
              <span
                :class="{
                  'text-green-600 font-bold': item.totalHoras >= 160,
                  'text-red-600 font-bold': item.totalHoras < 160,
                }"
              >
                {{ item.totalHoras }} hrs
              </span>
            </template>
  
            <template v-slot:item.diferencia="{ item }">
              <span
                :class="{
                  'text-green-600 font-bold': item.totalHoras > 160,
                  'text-red-600 font-bold': item.totalHoras < 160,
                  'text-gray-700 font-bold': item.totalHoras === 160,
                }"
              >
                {{ calcularDiferencia(item.totalHoras) }}
              </span>
            </template>
          </v-data-table>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script>
  export default {
    name: "HorasMensuales",
    data() {
      return {
        filtroDocente: "",
        filtroMes: "",
        meses: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        headers: [
          { text: "Docente", value: "docente" },
          { text: "Mes", value: "mes" },
          { text: "Total Horas", value: "totalHoras" },
          { text: "Diferencia", value: "diferencia" },
        ],
        horasMensuales: [
          { docente: "Juan Pérez", mes: "Marzo", totalHoras: 120 },
          { docente: "Ana Gómez", mes: "Marzo", totalHoras: 170 },
          { docente: "Carlos Ruiz", mes: "Marzo", totalHoras: 160 },
          { docente: "Ana Gómez", mes: "Febrero", totalHoras: 155 },
        ],
      };
    },
    computed: {
      filtrados() {
        return this.horasMensuales.filter((item) => {
          const docenteCoincide = item.docente.toLowerCase().includes(this.filtroDocente.toLowerCase());
          const mesCoincide = this.filtroMes ? item.mes === this.filtroMes : true;
          return docenteCoincide && mesCoincide;
        });
      },
    },
    methods: {
      calcularDiferencia(horas) {
        const diff = horas - 160;
        const signo = diff > 0 ? "+" : diff < 0 ? "" : "";
        const emoji = diff > 0 ? "✅" : diff < 0 ? "❌" : "✔️";
        return `${signo}${diff} hrs ${emoji}`;
      },
    },
  };
  </script>
  