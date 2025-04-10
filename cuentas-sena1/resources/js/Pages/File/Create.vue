<template>
  <div>
    <button @click="setShow" class="create-button">
      Crear Ficha
    </button>

    <Teleport to="body">
      <Modal :show="show" max-width="4xl" @close="close">
        <div v-if="show" class="modal-overlay">
          <div class="modal-content">
            <img src="/img/logo-sena.png" alt="Logo SENA" class="logo" />
            <h2 class="title">Ficha de Formación</h2>

            <form @submit.prevent="submit" class="form">
              <div class="form-grid">
                <div class="form-group">
                  <InputLabel class="label">Número de ficha</InputLabel>
                  <input v-model="form.numero_ficha" class="input" />
                </div>

                <div class="form-group">
                  <InputLabel class="label">Instructor líder</InputLabel>
                  <input v-model="form.instructor_lider" class="input" />
                </div>

                <div class="form-group">
                  <InputLabel class="label">Jornada</InputLabel>
                  <select v-model="form.jornada" class="input">
                    <option disabled value="">Selecciona una jornada</option>
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noche">Noche</option>
                    <option value="Mixta">Mixta</option>
                  </select>
                </div>

                <div class="form-group">
                  <InputLabel class="label">Horario de Formación</InputLabel>
                  <select v-model="form.horario" class="input">
                    <option disabled value="">Selecciona un horario</option>
                    <option value="06:00 - 12:00">06:00 - 12:00</option>
                    <option value="12:00 - 18:00">12:00 - 18:00</option>
                    <option value="18:00 - 23:00">18:00 - 23:00</option>
                  </select>
                </div>

                <div class="form-group">
                  <InputLabel class="label">Ambiente</InputLabel>
                  <input v-model="form.ambiente" class="input" />
                </div>

                <div class="form-group">
                  <InputLabel class="label">Días de formación</InputLabel>
                  <select v-model="form.dias_formacion" class="input">
                    <option disabled value="">Selecciona los días</option>
                    <option value="lunes">Lunes a Sábado</option>
                  </select>
                </div>
              </div>

              <div class="button-group">
                <button type="button" @click="close" class="button cancel">
                  Cancelar
                </button>
                <button type="submit" class="button submit">
                  Guardar
                </button>
              </div>
            </form>
          </div>
        </div>
      </Modal>
    </Teleport>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';

const show = ref(false);

const setShow = () => (show.value = true);
const close = () => (show.value = false);

const form = useForm({
  numero_ficha: '',
  instructor_lider: '',
  jornada: '',
  horario: '',
  ambiente: '',
  dias_formacion: '',
});

const submit = () => {
  form.post(route('files.store'), {
    onSuccess: () => {
      show.value = false;
      form.reset();
    },
  });
};
</script>

<style scoped>
.create-button {
  background-color: #39b54a;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
}

.create-button:hover {
  background-color: #2d8e3a;
}

.modal-overlay {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background-color: white;
  border-radius: 8px;
  padding: 24px;
  width: 100%;
  max-width: 42rem;
}

.logo {
  height: 80px;
  margin: 0 auto 16px;
  display: block;
}

.title {
  font-size: 24px;
  font-weight: 600;
  text-align: center;
  margin-bottom: 16px;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}

.form-group {
  margin-bottom: 12px;
}

.label {
  display: block;
  font-size: 16px;
  font-weight: 500;
  color: #000;
  margin-bottom: 4px;
}

.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  color: #000;
}

.input:focus {
  outline: none;
  border-color: #39b54a;
  box-shadow: 0 0 0 2px rgba(57, 181, 74, 0.2);
}

.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
}

.button {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  color: white;
}

.cancel {
  background-color: #9ca3af;
}

.cancel:hover {
  background-color: #6b7280;
}

.submit {
  background-color: #2563eb;
}

.submit:hover {
  background-color: #1d4ed8;
}

select.input {
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 8px center;
  background-size: 16px;
  padding-right: 32px;
}
</style>
