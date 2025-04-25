<template>
    <ApplicationLogo></ApplicationLogo>
    <v-app :theme="darkMode ? 'dark' : 'light'">
      <v-app-bar app color="primary" dark>
        <v-toolbar-title>Reporte General</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-btn @click="$inertia.visit('/reportes')"
        :color="isActive('/reportes') ? 'secondary' : 'default'"
        variant="flat"
        class="mx-2"
        >Disponibilidad de Instructores</v-btn>

        <v-btn @click="$inertia.visit('/asignacion')"
        :color="isActive('/asignacion') ? 'secondary' : 'default'"
        variant="flat"
        class="mx-2"
        >Asignación de Transversales</v-btn>

        <v-btn @click="$inertia.visit('/horasmensuales')"
        :color="isActive('/horasmensuales') ? 'secondary' : 'default'"
        variant="flat"
        class="mx-2"
        >Horas Mensuales</v-btn>

        <v-spacer></v-spacer>


      <v-btn icon @click="toggleDarkMode" variant="text">
        <v-icon>{{ darkMode ? 'mdi-white-balance-sunny' : 'mdi-moon-waning-crescent' }}</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <slot></slot>
    </v-main>
  </v-app>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const page = usePage()
const darkMode = ref(false)

const isActive = (routeName) => {
  return page.props.ziggy.location.endsWith(routeName)
}

const toggleDarkMode = () => {
  darkMode.value = !darkMode.value
}
</script>