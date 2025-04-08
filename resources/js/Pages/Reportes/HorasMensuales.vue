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
            <v-select
              v-model="ordenPor"
              :items="opcionesOrden"
              label="Ordenar por"
              item-title="text"
              item-value="value"
              prepend-icon="mdi-sort"
              class="mt-2 md:mt-0"
            />

            <v-btn color="secondary" @click="toggleOrdenamiento" class="mt-2 md:mt-0">
              Orden {{ ordenAscendente ? '▲' : '▼' }}
            </v-btn>
            <v-btn
            color="primary"
            @click="limpiarFiltros"
            class="mt-2 md:mt-0"
          >
            Borrar filtros
          </v-btn>
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
  import AppLayout from '@/Layouts/AppLayout.vue'
  export default {
    name: 'reportes.horasmensuales',
    layout: AppLayout,
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
          { docente: "Juan Pérez", mes: "Abril", totalHoras: 120 },
          { docente: "Ana Gómez", mes: "Abril", totalHoras: 170 },
          { docente: "Carlos Ruiz", mes: "Abril", totalHoras: 160 },
          { docente: "Ana Gómez", mes: "Febrero", totalHoras: 155 },
          { docente: "Juan Pérez", mes: "Marzo", totalHoras: 120 },
          { docente: "Ana Gómez", mes: "Marzo", totalHoras: 170 },
          { docente: "Carlos Ruiz", mes: "Marzo", totalHoras: 160 },
          { docente: "Ana Gómez", mes: "Febrero", totalHoras: 155 },
          { docente: "Juan Pérez", mes: "Marzo", totalHoras: 120 },
          { docente: "Ana Gómez", mes: "Marzo", totalHoras: 170 },
          { docente: "Carlos Ruiz", mes: "Marzo", totalHoras: 160 },
          { docente: "Ana Gómez", mes: "Abril", totalHoras: 155 },
          { docente: "Juan Pérez", mes: "Abril", totalHoras: 120 },
          { docente: "Ana Gómez", mes: "Abril", totalHoras: 170 },
          { docente: "Carlos Ruiz", mes: "Marzo", totalHoras: 160 },
          { docente: "Ana Gómez", mes: "Febrero", totalHoras: 155 },
        ],
        ordenAscendente: true,
        ordenPor: "mes",
        opcionesOrden: [
          { text: "Docente", value: "docente" },
          { text: "Mes", value: "mes" },
          { text: "Total Horas", value: "totalHoras" },
],
      };
    },
    computed: {
      filtrados() {
        let filtrados = this.horasMensuales.filter((item) => {
          const docenteCoincide = item.docente.toLowerCase().includes(this.filtroDocente.toLowerCase());
          const mesCoincide = this.filtroMes ? item.mes === this.filtroMes : true;
          return docenteCoincide && mesCoincide;
        });

        return filtrados.sort((a, b) => {
          let campoA = a[this.ordenPor];
          let campoB = b[this.ordenPor];

          // Normalizar strings para comparación
          if (typeof campoA === 'string') campoA = campoA.toLowerCase();
          if (typeof campoB === 'string') campoB = campoB.toLowerCase();

          if (this.ordenAscendente) {
            return campoA > campoB ? 1 : campoA < campoB ? -1 : 0;
          } else {
            return campoA < campoB ? 1 : campoA > campoB ? -1 : 0;
          }
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
      toggleOrdenamiento() {
        this.ordenAscendente = !this.ordenAscendente;
      },
      limpiarFiltros() {
        this.filtroDocente = "";
        this.filtroMes = "";
      },
    },
  };
  </script>
  