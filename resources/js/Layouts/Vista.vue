<template>
    <v-app>
      <v-app-bar app>
        <v-btn to="/disponibilidad">Disponibilidad</v-btn>
        <v-btn to="/assign">Asignar Materias</v-btn>
        <v-btn to="/history">Histórico</v-btn>
      </v-app-bar>
  
      <v-main>
        <slot></slot>
      </v-main>
    </v-app>
  </template>
  