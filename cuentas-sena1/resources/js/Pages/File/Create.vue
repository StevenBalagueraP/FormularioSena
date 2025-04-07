<template>
  <div>
    <button @click="showModal = true" class="bg-green-600 text-white px-4 py-2 rounded">
      Crear Ficha
    </button>

    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      
      <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
        <ApplicationLogo class="mx-auto h-20 w-16"/>
      
        <h2 class="text-xl font-semibold mb-4 text-center">Ficha de Formación</h2>
       
        <form @submit.prevent="submit">
         
          <div class="grid grid-cols-2 gap-4">
            <div>
              
              <label>Número de ficha</label>
              <input v-model="form.numero_ficha" class="input" />
            </div>
             
            <div>
              <label>Instructor líder</label>
              <input v-model="form.instructor_lider" class="input" />
            </div>

            <div>
              <label>Jornada</label>
              <select v-model="form.jornada" class="input">
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
                <option value="Mixta">Mixta</option>
              </select>
            </div>

            <div>
              <label>Horario</label>
              <select v-model="form.horario" class="input">
                <option value="06:00 - 12:00">06:00 - 12:00</option>
                <option value="12:00 - 18:00">12:00 - 18:00</option>
                <option value="18:00 - 23:00">18:00 - 23:00</option>
              </select>
            </div>

            <div>
              <label>Ambiente</label>
              <input v-model="form.ambiente" class="input" />
            </div>

            <div>
              <label>Días de formación</label>
              <select v-model="form.dias_formacion" class="input" >
                <option value="lunes">Lunes a Sabado</option>
              </select>
            </div>
          </div>
          
          <div class="mt-6 flex justify-end space-x-2">
            <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-400 rounded text-white">
              Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white">
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';



const showModal = ref(false);

const form = useForm({
  numero_ficha: '',
  instructor_lider: '',
  jornada: '',
  horario: '',
  ambiente: '',
  dias_formacion: []
});

const submit = () => {
  form.post(route('files.store'), {
    onSuccess: () => {
      showModal.value = false;
      form.reset();
    }
  });
};
</script>

<style scoped>
.input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 0.375rem;
}
</style>
