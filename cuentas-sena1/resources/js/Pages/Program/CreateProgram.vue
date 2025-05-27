<template>
  <Dashboard>
    <div class="w-full overflow-x-hidden">
      <!-- Mensaje flash simple -->
      <div v-if="$page.props.flash?.message"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ $page.props.flash.message }}
      </div>

      <!-- Botón para abrir el modal -->
      <button @click="showModal = true" class="mb-4 bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark">
        Crear Nuevo Programa
      </button>

      <!-- Modal Component -->
      <Modal :show="showModal" @close="showModal = false" max-width="2xl">
        <div class="p-6 max-w-3xl mx-auto">
          <h2 class="text-lg font-medium text-gray-900 mb-4">
            {{ isEditing ? 'Editar Programa' : 'Crear Nuevo Programa' }}
          </h2>

          <form @submit.prevent="submitForm" class="space-y-4">
            <!-- Denominación y Código -->
            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="denominacion" class="formulario-label">Denominación del Programa</label>
                <input type="text" id="denominacion" v-model="form.denominacion" class="formulario-input" required>
              </div>
              <div>
                <label for="codigo" class="formulario-label">Código del Programa</label>
                <input type="text" id="codigo" v-model="form.codigo" class="formulario-input" required>
              </div>
            </div>

            <!-- Versión del Programa (ancho completo) -->
            <div class="w-full">
              <label for="version" class="formulario-label">Versión del Programa</label>
              <input type="text" id="version" v-model="form.version" class="formulario-input" required>
            </div>

            <!-- Fechas en la misma fila -->
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="fecha_inicio" class="formulario-label">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" v-model="form.fecha_inicio" class="formulario-input" required>
              </div>
              <div>
                <label for="fecha_fin" class="formulario-label">Fecha de Fin</label>
                <input type="date" id="fecha_fin" v-model="form.fecha_fin" class="formulario-input" required>
              </div>
            </div>

            <!-- Duración -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="etapa_lectiva" class="formulario-label">Etapa Lectiva (horas)</label>
                <input type="number" id="etapa_lectiva" v-model="form.etapa_lectiva" class="formulario-input" required>
              </div>
              <div>
                <label for="etapa_productiva" class="formulario-label">Etapa Productiva (horas)</label>
                <input type="number" id="etapa_productiva" v-model="form.etapa_productiva" class="formulario-input"
                  required>
              </div>
              <div>
                <label for="duracion_total" class="formulario-label">Duración Total (horas)</label>
                <input type="number" id="duracion_total" v-model="form.duracion_total" class="formulario-input"
                  readonly>
              </div>
            </div>

            <!-- Título y Sectores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="titulo_certificado" class="formulario-label">Título o Certificado</label>
                <input type="text" id="titulo_certificado" v-model="form.titulo_certificado" class="formulario-input"
                  required>
              </div>
              <div>
                <label for="sectores" class="formulario-label">Sectores</label>
                <input type="text" id="sectores" v-model="form.sectores" class="formulario-input" required>
              </div>
            </div>

            <!-- Justificación -->
            <div>
              <label for="justificacion" class="formulario-label">Justificación</label>
              <textarea id="justificacion" v-model="form.justificacion" rows="4" class="formulario-input"
                required></textarea>
            </div>

            <!-- Modalidad -->
            <div>
              <label for="modalidad" class="formulario-label">Modalidad</label>
              <select id="modalidad" v-model="form.modalidad" class="formulario-input" required>
                <option value="">Seleccione una modalidad</option>
                <option value="Presencial">Presencial</option>
                <option value="Virtual">Virtual</option>
                <option value="Mixta">Mixta</option>
              </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-3 mt-6">
              <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                @click="closeModal">
                Cancelar
              </button>
              <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                Guardar
              </button>
            </div>
          </form>
        </div>
      </Modal>

      <!-- DataTable Component -->
      <div class="bg-white rounded-lg shadow p-4 overflow-hidden">
        <div class="mt-4 w-full overflow-x-auto">
          <div class="min-w-full max-w-full md:w-full lg:w-full">
            <DataTableNew 
              :data="tableData" 
              :columns="columns" 
              :customcomponent="customComponent"
              class="text-xs md:text-sm w-full table-auto"
            >
              <template #action="{ rowData }">
                <div class="flex items-center gap-2">
                  <Checkbox 
                    :checked="rowData.checked" 
                    @update:checked="(val) => rowData.checked = val" 
                  />
                  <button 
                    @click="customComponent.actions.edit(rowData)"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded inline-flex items-center text-sm whitespace-nowrap"
                  >
                    Editar
                  </button>
                  <button 
                    @click="customComponent.actions.delete(rowData)"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded inline-flex items-center text-sm whitespace-nowrap"
                  >
                    Eliminar
                  </button>
                </div>
              </template>
            </DataTableNew>
          </div>
        </div>
      </div>
    </div>
  </Dashboard>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import DataTableNew from '@/ComponentesNew/DataTableNew.vue';
import Dashboard from '@/Pages/Dashboard.vue'; // Import Dashboard
import Checkbox from '@/Components/Checkbox.vue'; // Import Checkbox component

const page = usePage();
const showModal = ref(false);
const isEditing = ref(false);
const editId = ref(null);

// Obtener los programas de las props
const props = defineProps({
  programs: {
    type: Array,
    default: () => []
  }
});

// Computed para datos de la tabla
const tableData = computed(() => props.programs || []);

const form = ref({
  denominacion: '',
  codigo: '',
  version: '',
  fecha_inicio: '',
  fecha_fin: '',
  etapa_lectiva: 0,
  etapa_productiva: 0,
  duracion_total: 0,
  titulo_certificado: '',
  justificacion: '',
  sectores: '',
  modalidad: ''
});

// Añadir watch para calcular duración total automáticamente
watch(
  [() => form.value.etapa_lectiva, () => form.value.etapa_productiva],
  ([newLectiva, newProductiva]) => {
    const lectiva = parseInt(newLectiva) || 0;
    const productiva = parseInt(newProductiva) || 0;
    form.value.duracion_total = lectiva + productiva;
  },
  { immediate: true }
);

const closeModal = () => {
  showModal.value = false;
  isEditing.value = false;
  editId.value = null;
  form.value = {
    denominacion: '',
    codigo: '',
    version: '',
    fecha_inicio: '',
    fecha_fin: '',
    etapa_lectiva: 0,
    etapa_productiva: 0,
    duracion_total: 0,
    titulo_certificado: '',
    justificacion: '',
    sectores: '',
    modalidad: ''
  };
};

const submitForm = () => {
  const formData = {
    ...form.value,
    etapa_lectiva: parseInt(form.value.etapa_lectiva) || 0,
    etapa_productiva: parseInt(form.value.etapa_productiva) || 0,
    duracion_total: parseInt(form.value.duracion_total) || 0
  };

  if (isEditing.value) {
    router.put(route('program.update', editId.value), formData, {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
        router.reload({ only: ['programs'] });
      },
      onError: (errors) => {
        console.error('Errors:', errors);
      }
    });
  } else {
    router.post(route('program.store'), formData, {
      preserveScroll: true,
      onSuccess: () => {
        closeModal();
        router.reload({ only: ['programs'] });
      },
      onError: (errors) => {
        console.error('Errors:', errors);
      }
    });
  }
};

const columns = ref([
  { alias: 'ID', datacol: 'id' },
  { alias: 'Denominación', datacol: 'denominacion' },
  { alias: 'Código', datacol: 'codigo' },
  { alias: 'Versión', datacol: 'version' },
  { alias: 'Fecha Inicio', datacol: 'fecha_inicio' },
  { alias: 'Fecha Fin', datacol: 'fecha_fin' },
  { alias: 'E. Lectiva', datacol: 'etapa_lectiva' },
  { alias: 'E. Productiva', datacol: 'etapa_productiva' },
  { alias: 'Duración Total', datacol: 'duracion_total' },
  { alias: 'Título/Certificado', datacol: 'titulo_certificado' },
  { alias: 'Justificación', datacol: 'justificacion' },
  { alias: 'Sectores', datacol: 'sectores' },
  { alias: 'Modalidad', datacol: 'modalidad' }
]);

const customComponent = ref({
  actions: {
    edit: (program) => {
      isEditing.value = true;
      editId.value = program.id;
      form.value = {
        ...program,
        etapa_lectiva: parseInt(program.etapa_lectiva),
        etapa_productiva: parseInt(program.etapa_productiva),
        duracion_total: parseInt(program.duracion_total)
      };
      showModal.value = true;
    },
    delete: (program) => {
      if (confirm(`¿Estás seguro de eliminar el programa "${program.denominacion}"?`)) {
        router.delete(route('program.destroy', program.id), {
          preserveScroll: true,
          onSuccess: () => {
            router.reload({ only: ['programs'] });
          },
          onError: (errors) => {
            console.error('Error al eliminar:', errors);
          }
        });
      }
    }
  }
});
</script>

<style scoped>
.formulario-row {
  @apply mb-4 flex flex-wrap gap-4;
}

.formulario-label {
  @apply block text-sm font-medium text-gray-700 mb-1;
}

.formulario-input {
  @apply w-full p-1.5 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}

.formulario-labelDuracion {
  @apply block text-sm font-medium text-gray-700 mb-1 w-full;
}

:deep(.table-container) {
  @apply text-xs md:text-sm w-full;
  overflow-x: auto;
}

:deep(table) {
  @apply w-full table-fixed;
}

:deep(td),
:deep(th) {
  @apply p-2 truncate;
  max-width: 150px;
}

:deep(th) {
  @apply bg-gray-50 font-medium;
}

.animate-fade-in-down {
  animation: fadeInDown 0.5s ease-out;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
