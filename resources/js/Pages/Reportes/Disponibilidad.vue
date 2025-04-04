<template>
  <div :class="{ 'dark bg-gray-900 text-white': isDarkMode }" class="p-4 min-h-screen transition-colors">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Disponibilidad de Instructores</h2>
      <button @click="toggleDarkMode" class="px-4 py-2 border rounded-lg shadow">
        {{ isDarkMode ? 'Modo Claro' : 'Modo Oscuro' }}
      </button>
    </div>

    <FullCalendar
      :options="calendarOptions"
      class="border rounded shadow bg-white dark:bg-gray-800 dark:text-white"
    />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import Vista from '../../Layouts/Vista.vue';

export default {
  name: "Disponibilidad",
  components: { FullCalendar },
  data() {
    return {
      layout: Vista,
      isDarkMode: localStorage.getItem("darkMode") === "true",
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: "timeGridWeek",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        events: [
          { title: "Juan Pérez - Matemáticas", start: "2025-04-01T06:00:00", end: "2025-04-01T12:00:00" },
          { title: "María López - Física", start: "2025-04-01T12:00:00", end: "2025-04-01T18:00:00" },
          { title: "Carlos Sánchez - Química", start: "2025-04-01T18:00:00", end: "2025-04-01T23:00:00" },
          { title: "María López - Física", start: "2025-04-02T12:00:00", end: "2025-04-02T18:00:00" },
          { title: "Carlos Sánchez - Química", start: "2025-04-03T14:00:00", end: "2025-04-03T16:00:00" },
        ],
        allDaySlot: false,
        slotMinTime: "06:00:00",
        slotMaxTime: "23:00:00",
        height: "auto",
      },
    };
  },
  methods: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
      localStorage.setItem("darkMode", this.isDarkMode);
    },
  },
};
</script>


<style>
/* FullCalendar ajustado al modo oscuro */
.dark .fc {
  background-color: #1f2937;
  color: white;
}
</style>
