<template>
    <div class="report-container">
        <h1 class="report-title">Reporte de Datos</h1>
        <button @click="generateReport" class="generate-button">Generar Reporte</button>
    
        <div v-if="loading" class="loading-spinner">Cargando...</div>
    
        <div v-if="!loading && reportData.length === 0" class="no-data-message">
        No se encontraron datos para los filtros seleccionados.
        </div>
    
        <table v-if="!loading && reportData.length > 0" class="report-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in reportData" :key="item.id" @click="showDetails(item)">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>
            <button class="edit-button">Editar</button>
            <button class="delete-button">Eliminar</button>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { router } from '@inertiajs/vue3'

    const loading = ref(false);
    const reportData = ref([]);

    const generateReport = () => {
    loading.value = true;
    setTimeout(() => {
    reportData.value = [
        { id: 1, name: 'Ejemplo 1' },
        { id: 2, name: 'Ejemplo 2' }
    ];
    loading.value = false;
    }, 2000);
};

const showDetails = (item) => {
    alert(`Detalles de ${item.name}`);
};
</script>

<style>
    .report-container {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.report-title {
    font-size: 24px;
    text-align: center;
    margin-bottom: 10px;
}

.generate-button {
    display: block;
    margin: 10px auto;
    padding: 10px 20px;
    background: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.loading-spinner {
    text-align: center;
    font-size: 18px;
    margin-top: 10px;
}

.no-data-message {
    text-align: center;
    font-size: 16px;
    color: #555;
    margin-top: 10px;
}
.report-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
.report-table th, .report-table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.edit-button, .delete-button {
    padding: 5px 10px;
    margin: 2px;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 4px;
}

.edit-button {
    background: #28a745;
}

.delete-button {
    background: #dc3545;
}
</style>
