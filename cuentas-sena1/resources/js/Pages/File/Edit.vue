<script setup>

import Checkbox from '@/Components/Checkbox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

</script>
<template>
      <PrimaryButton Class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-2 py-1 rounded">
        Editar
    </PrimaryButton>
    <PrimaryButton Class="bg-red-500 hover:bg-red-200 text-white text-xs px-2 py-1 rounded">
    Eliminar
   </PrimaryButton>
   <Checkbox Class="border-gray-400 bg-White-500 rounded"/>
</template>
