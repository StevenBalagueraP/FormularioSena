<template>
    <Dashboard>
      <div class="container px-5">
        <button @click="show = true" class="bg-primary text-white">
          <span class="icon">+</span> Registrar competencia
        </button>
      </div>
  
      <Teleport to="body">
        <Modal :show="show" max-width="4xl" @close="show = false">
          <div class="p-6 space-y-4">
            <!-- Nombre -->
            <div>
              <TextInput
                id="Norma"
                type="text"
                class="mt-1 block w-full"
                placeholder="Nombre"
                v-model="form.norma"
                required
                autofocus
                autocomplete="nombre"
              />
              <InputError :message="form.errors.nombre" class="mt-2" />
            </div>
  
            <!-- Código -->
            <div>
              <TextInput
                id="Codigo"
                type="text"
                class="mt-1 block w-full"
                placeholder="Código"
                v-model="form.codigo"
                required
                autocomplete="codigo"
              />
              <InputError :message="form.errors.codigo" class="mt-2" />
            </div>
  
            <!-- Descripción -->
            <div>
              <TextInput
                id="Nombre"
                type="text"
                class="mt-1 block w-full"
                placeholder="Descripción"
                v-model="form.nombre"
                required
                autocomplete="descripcion"
              />
              <InputError :message="form.errors.descripcion" class="mt-2" />
            </div>
  
            <!-- Duración -->
            <div>
              <TextInput
                id="Duracion"
                type="number"
                class="mt-1 block w-full"
                placeholder="Duración (en horas)"
                v-model="form.duracion"
                required
                autocomplete="duracion"
              />
              <InputError :message="form.errors.duracion" class="mt-2" />
            </div>
  
            <!-- Botón enviar -->
            <div class="mt-4">
              <button @click="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar
              </button>
            </div>
          </div>
        </Modal>
      </Teleport>

      <!-- Llamar al componente DataTable -->
      <DataTableNew
        :data="tableData"
        :columns="tableColumns"
        :customcomponent="customComponent"
      />
    </Dashboard>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Dashboard from '@/Pages/Dashboard.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import DataTableNew from '@/ComponentesNew/DataTableNew.vue';

// Mostrar modal
const show = ref(false);

// Campos del formulario
const form = useForm({
  norma: '',
  codigo: '',
  nombre: '',
  duracion: ''
});

// Datos para la tabla
const tableData = ref([
  { id: 1, norma: 'Norma 1', codigo: '001', nombre: 'Competencia 1', duracion: 40 },
  { id: 2, norma: 'Norma 2', codigo: '002', nombre: 'Competencia 2', duracion: 60 },
  // Agrega más datos aquí
]);

// Columnas para la tabla
const tableColumns = [
  { alias: 'Norma', datacol: 'norma' },
  { alias: 'Código', datacol: 'codigo' },
  { alias: 'Nombre', datacol: 'nombre' },
  { alias: 'Duración (horas)', datacol: 'duracion' }
];

// Componente personalizado para acciones
const customComponent = {
  template: `<button class="bg-red-500 text-white px-2 py-1 rounded" @click="deleteRow">Eliminar</button>`,
  methods: {
    deleteRow() {
      alert('Eliminar fila');
    }
  }
};

// Enviar formulario
const submit = () => {
  form.post(route('ayuda.store'), {
    onSuccess: () => {
      show.value = false;
      form.reset();
      // Agregar el nuevo registro a la tabla
      tableData.value.push({ ...form });
    }
  });
};
</script>