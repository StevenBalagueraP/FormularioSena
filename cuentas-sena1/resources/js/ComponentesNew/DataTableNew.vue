<template>
    <div class=" flex relative max-xl mx-auto justify-center my-10">
      <!-- Input de búsqueda -->
      <div class="relative w-full">
        <input v-model="searchQuery" type="text" placeholder="Search"
          class="w-full py-3 px-4 border border-gray-300 rounded-md shadow-sm pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        <!-- Botón con ícono de lupa -->
        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700 hover:text-gray-900">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M14.795 13.408l5.204 5.204a1 1 0 01-1.414 1.414l-5.204-5.204a7.5 7.5 0 111.414-1.414zM8.5 14A5.5 5.5 0 103 8.5 5.506 5.506 0 008.5 14z" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Filtros por fechas -->
    <div class="flex justify-center space-x-4 my-4">

      <label for="start-date" class="mr-2">Start Date:</label>
      <input v-model="startDate" type="date" id="start-date" class="py-2 px-4 border border-gray-300 rounded-md" />

      <label for="end-date" class="ml-4 mr-2">End Date:</label>
      <input v-model="endDate" type="date" id="end-date" class="py-2 px-4 border border-gray-300 rounded-md" />


    </div>


    <!--Tabla 
    <div class="relative flex max-w-auto mx-auto justify-center">-->
    <div class="overflow-x-auto w-full">
      <table class="table-fixed uniform-table w-full h-full">
        <thead>
          <tr class="h-full">
            <th class="fa fa-angle-double-down text-center" v-for="column in columns"
              @click="orderByColumn(column.datacol, column.datasubcol)">{{ column.alias }}
              <template v-if="sortedColumn == column.datacol">
                <svg v-if="sortOrder" class="inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <polygon points="12 17.414 3.293 8.707 4.707 7.293 12 14.586 19.293 7.293 20.707 8.707 12 17.414" />
                </svg>
                <svg v-else class="inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                  <path d="m12 6.586-8.707 8.707 1.414 1.414L12 9.414l7.293 7.293 1.414-1.414L12 6.586z" />
                </svg>
              </template>
            </th>
            <th>Action </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="rowData in filteredData" :key="rowData.id">
            <template v-for="column in columns">
              <template v-if="!column.col_array">
                <td>
                  <template v-if="rowData.editing">
                    <input v-if="column.datasubcol" v-model="rowData[column.datacol][column.datasubcol]" type="text"
                      class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm" />
                    <input v-else v-model="rowData[column.datacol]" type="text"
                      class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm" />
                    Debería correr el proyecto
                  </template>
                  <template v-else>
                    <span v-if="column.datasubcol">{{ rowData[column.datacol][column.datasubcol] }}</span>
                    <span v-else>{{ rowData[column.datacol] }}</span>

                  </template>
                </td>
              </template>
              <template v-else>
                <td :class="column.class">
                  <ul class="list-none flex space-x-1">
                    <li v-for="row in rowData[column.datacol]" class="bg-red-500 text-white p-2">{{
                      row[column.datasubcol]
                      }}</li>
                  </ul>
                </td>
              </template>
            </template>
            <!-- Botón de Editar fila -->
            <td class="py-2 px-4 border-b h-full flex items-center justify-center  space-x-2">
              
                <!-- Tooltip que aparece al pasar el mouse sobre el icono -->
                <span
                  class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 px-2 py-1 text-xs text-Black rounded opacity-0 group-hover:opacity-100 transition">
                  Delete row
                </span>
              <!--</div>-->
              <customcomponent style="min"
              :edit="rowData" ></customcomponent>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

<script setup>
import { ref, computed } from "vue";
import { defineProps, defineEmits } from 'vue';

// Definición de propiedades del componente
const props = defineProps({
  data: { type: Array, default: [] },
  columns: { type: Array, default: [] },
  customcomponent: { type: Object, default: null },
});

// Estado de ordenamiento
const sortKey = ref("name"); // Columna a ordenar
const sortOrder = ref(true); // Dirección de orden: asc o desc
const searchQuery = ref(""); // Variable para almacenar lo que se digita en el campo de búsqueda
const startDate = ref(""); // Variable para almacenar lo que se digita en el campo de fecha inicial
const endDate = ref(""); // Variable para almacenar lo que se digita en el campo de fecha final

// Columnas de ordenamiento
const sortedColumn = ref(props.columns[0].datacol);
const sortedSubColumn = ref(null);
const sortDirection = ref("asc");

// Variables para el filtro
const find_filter = ref(false);

// Emitir eventos
//const emit = defineEmits(["edit", "save"]);

// Ordenar columnas
const orderByColumn = (column, subcolumn = null) => {
  if (sortedColumn.value === column) sortOrder.value = !sortOrder.value;
  else sortOrder.value = true;
  sortedColumn.value = column;
  sortedSubColumn.value = subcolumn;
};

// Filtro de datos
const filteredData = computed(() => {
  let filtered = [...props.data];

  // Filtro por búsqueda
  if (searchQuery.value) {
    filtered = filtered.filter((item) => {
      return props.columns.some((column) => {
        const columnValue = column.datasubcol
          ? item[column.datacol][column.datasubcol]
          : item[column.datacol];
        if (typeof columnValue === 'number') {
          // ojo filtrar números 
        }
        else {
          return columnValue
            ? columnValue.toLowerCase().includes(searchQuery.value.toLowerCase())
            : false;
        }
      });
    });
  }

  // Filtro por rango de fechas
  if (startDate.value && endDate.value) {
    filtered = filtered.filter((item) => {
      const itemDate = new Date(item.date); // Asegúrate de que la propiedad 'date' sea correcta

      // Normalizar las fechas de entrada (startDate, endDate) y la fecha de los registros
      const start = new Date(startDate.value);
      const end = new Date(endDate.value);

      // Compara las fechas asegurando que se normalicen correctamente
      return itemDate >= start && itemDate <= end;
    });
  }

  // Ordenar datos según la columna seleccionada
  filtered.sort((a, b) => {
    let valueA = sortedSubColumn.value
      ? a[sortedColumn.value][sortedSubColumn.value]
      : a[sortedColumn.value];
    let valueB = sortedSubColumn.value
      ? b[sortedColumn.value][sortedSubColumn.value]
      : b[sortedColumn.value];

    if (typeof valueA === "string" && typeof valueB === "string")
      return valueA.localeCompare(valueB);
    else if (typeof valueA === "number" && typeof valueB === "number")
      return valueA - valueB;
    return 0;
  });

  // Invertir el orden si es necesario
  return sortOrder.value ? filtered : filtered.reverse();
});

// Función para filtrar por rango de fechas
const filterByDateRange = () => {
  // Esta función puede estar vacía si el filtro por fechas ya está manejado en el computed 'filteredData'
  // Pero puedes forzar la actualización del filtro si es necesario
  filteredData.value = filteredData.value; // Forzar la actualización
};

//const edit = (item) => {
//item.editing = true;
//item.saving = false;
//emit("edit");
//};

const save = (item) => {
  item.saving = true;
  item.editing = false;
  emit("save", item);
};
</script>

<style scoped>
/* Opcional: Ajustar sombra y transiciones para diseño más suave */
button {
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15);
}

input {
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-fecha {
  background-color: #4775d1;
  /* Fondo */
  color: #fff;
  /* Texto oscuro para contraste */
  border: none;
  /* Sin bordes */
  /*padding: 10px 20px;  Espaciado interno */
  font-size: 16px;
  /* Tamaño de fuente */
  border-radius: 5px;
  /* Bordes redondeados */
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
  /* Sombra ligera */
  /* display: flex;
    align-items: center;
    gap: 8px; /* Espacio entre el icono y el texto */
  cursor: pointer;
  /* Manito al pasar */
  transition: background-color 0.3s ease, transform 0.2s ease;
  /* Efecto al interactuar */
}

.btn-fecha:hover {
  background-color: #3366cc;
  /* Fondo más oscuro al pasar el mouse */
  transform: scale(1.05);
  /* Agrandar un poco al pasar el mouse */
}

.btn-fecha:active {
  transform: scale(0.98);
  /* Reducir un poco el tamaño al presionar */
}

.uniform-table {
  table-layout: fixed;
  width: 100%;
  height: 100%;
  border-collapse: collapse;
}

.uniform-table td {
  max-width: 200px;
  max-height: 200px;
  overflow: auto;
  word-wrap: break-word;
  text-overflow: ellipsis;
  padding: 2;
  font-size: 14px;
}

.uniform-table th,
.uniform-table td {
  border: 1px solid #ddd;
  text-align: center;
  padding: 8px;
}

.uniform-table th {
  background-color: #f4f4f4f3;
  font: bold;
}

.uniform-table .cell-content {
  width: 100%;
  height: 100%;
  overflow: auto;
  word-wrap: break-word;
  display: block;
  white-space: nowrap;
  box-sizing: border-box;

}

.uniform-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.uniform-table tr:nth-child(odd) {
  background-color: #fff;
}

.uniform-table tr:hover {
  background-color: #f1f1f1;
}

.cursor-pointer {
  cursor: pointer;
  cursor: ns-resize;
}

.titule {
  color: rgb(7, 7, 7);
  text-align: center;
  font: 100% sans-serif;
  font-weight: bold;
}

.btn {
  padding: 10px 10px;
  font-size: 12px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
  color: white;
}

.edit-btn {
  background-color: #fafbfa;
}

.edit-btn:hover {
  background-color: #d5f8d7;
  transform: scale(1.05);
}

.save-btn {
  background-color: #4775d1;
}

.save-btn:hover {
  background-color: #2a61d0;
  transform: scale(1.05);
}

.delete-btn {
  background-color: #fb2b67;
}

.delete-btn:hover {
  background-color: #f60549;
  transform: scale(1.05);
}

.button-container {
  display: flex;
  gap: 20px;
  justify-content: center;
  margin-top: 20px;
  border-radius: 10px;
}

.tdb {
  display: flex;
  justify-content: center;
  gap: 5px;
}
</style>