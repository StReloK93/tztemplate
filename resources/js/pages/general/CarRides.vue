<template>
    <main>
        <div class="tw-flex tw-justify-between tw-items-center">
            <h3>Mashrutlar</h3> 
            <AddCarRides></AddCarRides>
        </div>
    </main>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import AddCarRides from './CarRides/AddCarRides.vue';
</script>