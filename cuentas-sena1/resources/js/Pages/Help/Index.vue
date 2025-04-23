<template>

    <Dashboard>
        <div class=" justify-evenly space-x-8">
        <Create />
        </div>

<button class="bg-primary text-white">
    hola
</button>

        <DataTable :data="helps" :columns="columns" :customcomponent='HelpEdit'/>
    </Dashboard> 
    
</template>
<script setup>
import Dashboard from '@/Pages/Dashboard.vue';
import DataTable from '@/ComponentesNew/DataTableNew.vue';
// import Create from './Create.vue';
import { ref } from 'vue';
import HelpEdit from './Edit.vue';




const show = ref(false);
const setShow = () => show.value = true;
const close = () => show.value = false;


const columns = ref([
    {alias:'Id', datacol:'id'},
    {alias:'Nombre', datacol:'nombre'},
    {alias:'Descripcion', datacol:'descripcion'},
    {alias:'Fecha de Creación', datacol:'created_at'},
    

    
   

])

const props = defineProps({
    helps:null,
})
</script>