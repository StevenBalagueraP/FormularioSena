<template>
  <div class="container1">
    <!-- Cuadro principal con diseño -->
    <div class="list-container1 hover-border1">
      <!-- Campo de búsqueda y seleccionar todo -->
      <div class="flex items-center w-full p-4">
        <input type="checkbox" id="selectAll" v-model="selectAll" class="mr-2" />
        <div class="search-bar1 hover-border1 w-full">
          <input type="text" v-model="searchQuery" placeholder="Buscar..." class="flex-grow outline-none w-full" />
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 absolute right-2 top-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 100 14 7 7 0 000-14zM21 21l-4.35-4.35" />
          </svg>
        </div>
      </div>

      <!-- Lista de elementos -->
      <div class="p-3">
        <ul class="list1">
          <li v-for="(item, index) in filteredItems" :key="index" class="list-item1 items-center mb-2">
            <input type="checkbox" v-model="selectedValues" :value="item[valuedata]" class="mr-2" />
            <span>{{ item[textdata] }}</span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Cuadro de elementos seleccionados -->
    <div class="selected-container1 hover-border1 section-select">
      <h3 class="font-bold mb-2">Elementos seleccionados:</h3>
      <div v-if="selectedText.length" class="flex flex-wrap gap-2 max-h-16 overflow-y-auto">
        <span v-for="(item, index) in selectedText" :key="index" class="selected-item1">
          {{ item }}
        </span>
      </div>
      <div v-else class="text-gray-500">No hay elementos seleccionados.</div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";

const props = defineProps({
  arraydata: { type: Array, required: true },
  textdata: { type: String, required: true },
  valuedata: { type: String, required: true },
  modelValue: { type: Array, required: true },
});

const emit = defineEmits(["update:modelValue"]);

// Variables reactivas
const searchQuery = ref("");
const selectedValues = ref([...props.modelValue]); // Inicializa con los valores actuales

// Computed para seleccionar todos
const selectAll = computed({
  get: () => selectedValues.value.length === props.arraydata.length,
  set: (newValue) => {
    selectedValues.value = newValue ? props.arraydata.map((item) => item[props.valuedata]) : [];
  },
});

// Filtra la lista según el input de búsqueda
const filteredItems = computed(() =>
  props.arraydata.filter((item) => item[props.textdata].toLowerCase().includes(searchQuery.value.toLowerCase()))
);

// Computed para obtener los textos de los elementos seleccionados
const selectedText = computed(() =>
  props.arraydata.filter((item) => selectedValues.value.includes(item[props.valuedata])).map((item) => item[props.textdata])
);

// Sincroniza cambios entre `selectedValues` y `modelValue`
watch(selectedValues, (newVal) => emit("update:modelValue", newVal));
watch(() => props.modelValue, (newVal) => (selectedValues.value = [...newVal]), { deep: true });

</script>

<style scoped>
.container1 {
  width: 300px;
  margin: 20px auto;
  background-color: white;
  padding: 15px;
  border-radius: 12px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.list-container1,
.selected-container1 {
  border: 1px solid #ccc;
  border-radius: 12px;
  background-color: white;
  transition: border-color 0.3s ease;
}

.hover-border1:hover {
  border-color: #0195ca;
}

.list1 {
  max-height: 90px;
  overflow-y: auto;
}

.list-item1 {
  display: flex;
  align-items: center;
  background-color: rgba(30, 144, 255, 0.1);
  border: 1px solid #0195ca;
  border-radius: 8px;
  padding: 8px;
  transition: background-color 0.2s;
}

.list-item1:hover {
  background-color: rgba(30, 144, 255, 0.3);
}

.selected-container1 {
  max-height: 80px;
  overflow-y: auto;
}

.selected-item1 {
  background-color: #0195ca;
  color: white;
  padding: 5px 10px;
  border-radius: 12px;
  font-size: 14px;
}

.search-bar1 {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
}

.search-bar1 input {
  padding-right: 30px;
  border-radius: 12px;
}

.search-bar1 svg {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
}

.section-select {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 5px;
  border-radius: 12px;
  background-color: white;
  border: 1px solid #ccc;
  width: 100%;
  transition: border-color 0.3s ease;
}

.colorblue {
    background-color: #0195ca;
}
.colorblue:hover {
    background-color: #0277A2;
}
.colorred {
    background-color: #fb6e52;
}
.colorred:hover {
    background-color: #cf4e3a;
}
.colorgreen {
    background-color: #02b387;
}
.colorgreen:hover {
    background-color: #009790;
}
.colorpurple {
    background-color: #ac92ed;
}
.colorpurple:hover {
    background-color: #8a63d2;
}
.coloryellow {
    background-color: #fdca55;
}
.coloryellow:hover {
    background-color: #fbbf24;
}

</style>