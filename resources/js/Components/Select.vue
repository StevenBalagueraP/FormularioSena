<template>
    <div class="container1">
      <div class="input-container1">
        <input
          type="text"
          id="search1"
          placeholder="Buscar en la lista..."
          v-model="searchQuery"
          @input="onSearchInput"
        />
        <span class="toggle-icon" @click="toggleList">
          <!-- Icono de mostrar lista -->
          <svg
            v-if="!isListVisible"
            xmlns="http://www.w3.org/2000/svg"
            fill="#000000"
            height="20px"
            width="20px"
            viewBox="0 0 511.787 511.787"
          >
            <g>
              <path d="M508.667,125.707c-4.16-4.16-10.88-4.16-15.04,0L255.76,363.573L18,125.707c-4.267-4.053-10.987-3.947-15.04,0.213 c-3.947,4.16-3.947,10.667,0,14.827L248.293,386.08c4.16,4.16,10.88,4.16,15.04,0l245.333-245.333 C512.827,136.693,512.827,129.867,508.667,125.707z"></path>
            </g>
          </svg>
          <!-- Icono de ocultar lista -->
          <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            fill="#000000"
            height="20px"
            width="20px"
            viewBox="0 0 511.787 511.787"
            transform="rotate(180)"
          >
            <g>
              <path d="M508.667,125.707c-4.16-4.16-10.88-4.16-15.04,0L255.76,363.573L18,125.707c-4.267-4.053-10.987-3.947-15.04,0.213 c-3.947,4.16-3.947,10.667,0,14.827L248.293,386.08c4.16,4.16,10.88,4.16,15.04,0l245.333-245.333 C512.827,136.693,512.827,129.867,508.667,125.707z"></path>
            </g>
          </svg>
        </span>
      </div>
      <ul id="list" v-show="isListVisible">
        <li
          v-for="(item, index) in filteredItems"
          :key="index"
          @click="selectItem(item)"
          :class="{'selected': searchQuery === item}"
        >
          {{ item[textdata] }}
        </li>
      </ul>
    </div>
  </template>
  
  
  <script setup>
  import { ref, computed } from 'vue';
  
  const props = defineProps({
    arraydata: { type: Array, default: [] },
    textdata: { type: String, default: '' },
    valuedata: { type: String, default: '' },
    modelValue: { type: String, default: '' },
  });
 
  const emit = defineEmits(['update:modelValue']);

  const isListVisible = ref(false); // Estado para controlar la visibilidad de la lista
  const searchQuery = ref('');
  const selectQuery = ref('');
  const items = ref(props.arraydata); // Arreglo de elementos
  
      
      // Filtro de elementos según la búsqueda
      const filteredItems = computed(() =>
  items.value.filter(item => 
    item[props.textdata] && item[props.textdata].toLowerCase().includes(searchQuery.value.toLowerCase())
  )
);
  
      // Se ejecuta al escribir en el campo de búsqueda
      const onSearchInput = () => {
        if (searchQuery.value.trim() !== '') {
          isListVisible.value = true; // Mostrar la lista cuando se comienza a escribir
        } else {
          isListVisible.value = false; // Ocultar la lista si no hay texto
        }
      };
  
      // Alternar la visibilidad de la lista
      const toggleList = () => {
        isListVisible.value = !isListVisible.value;
      };
  
      // Manejar la selección de un elemento de la lista
      const selectItem = (item) => {
        searchQuery.value = item[props.textdata]; // Coloca el elemento seleccionado en la caja de texto
        selectQuery.value = item[props.valuedata]; // Coloca el id del elemento seleccionado
        isListVisible.value = false; // Oculta la lista después de la selección
        emit('update:modelValue', selectQuery.value);
      };
  </script>
  
  <style scoped>
  .container1 {
  width: 300px;
  margin: 20px auto;
  text-align: center;
  box-sizing: border-box; /* Asegura que el ancho total de los elementos se calcule correctamente */
}

.input-container1 {
  position: relative;
  width: 100%;
}

#search1 {
  width: 100%;
  padding: 8px 35px 8px 8px; /* Espacio para el ícono */
  margin-bottom: 10px;
  border: 1px solid #0d0000;
  border-radius: 6px;
  font-family: Arial, sans-serif;
  box-sizing: border-box; /* Evita desbordes por el padding */
}

.toggle-icon {
  position: absolute;
  right: 10px; /* Ubica el ícono a la derecha del input */
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 16px;
  color: #555;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  max-height: 200px;
  overflow-y: auto;
  background-color: #f5f5f5;
  box-shadow: 0 4px 8px rgb(228, 226, 226);
  max-width: 100%; /* Asegura que no se desborde */
  margin-top: 10px; /* Separación con el input */
}

li {
  padding: 10px;
  border-bottom: 1px solid #eee;
  cursor: pointer;
  font-family: Arial, sans-serif;
  box-sizing: border-box; /* Evita que el padding cause desbordes */
}

li:hover {
  background-color:#4775d1;
  color: rgb(255, 255, 255);
  font-weight: bold;
}

li:last-child {
  border-bottom: none;
}

.selected {
  color: rgb(255, 255, 255);
  font-weight: bold;
  background-color: rgb(59 130 246);
}

  </style>
  