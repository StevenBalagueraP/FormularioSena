<template>
  <div class="p-4">
    <h2 class="text-lg font-semibold mb-2">Disponibilidad de Instructores</h2>
    <FullCalendar
      :options="calendarOptions"
      class="border rounded shadow"
    />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction"; // Para interactuar con eventos

export default {
  components: { FullCalendar },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: "timeGridWeek", // Vista semanal con horas
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
        allDaySlot: false, // No mostrar eventos de todo el día
        slotMinTime: "06:00:00", // Hora de inicio del día
        slotMaxTime: "23:00:00", // Hora de fin del día
        height: "auto",
      },
    };
  },
};
</script>

<style>
/* Ajustar tamaño para que no sea demasiado grande */
.fc {
  font-size: 14px;
}
</style>
