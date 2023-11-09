<template>
    <main class="d-flex tw-flex-col">
        <div class="tw-flex tw-justify-between tw-items-center mb-6">
            <h3>Qatnovlar</h3>
            <AddCarRides></AddCarRides>
        </div>
        <section class="tw-h-64">
            <AgGridVue class="h-100 ag-theme-alpine" :columnDefs="columnDefs" :rowData="pageData.car_rides" />
        </section>
    </main>
</template>

<script setup lang="ts">
import AddCarRides from './CarRides/AddCarRides.vue'
import { ColDef } from 'ag-grid-community'
import axios from '@/modules/axios'
import { reactive } from 'vue'

const pageData = reactive({
    car_rides: null
})

const columnDefs: ColDef[] = [
    { field: '', headerName: 'Transport №', cellRenderer: ({ data }) => `${data.car.type}  ${data.car.number}` },
    { field: 'start.name', headerName: 'Shahar | A ' },
    { field: 'end.name', headerName: 'Shahar | B' },
    { field: 'ride_time', headerName: 'Qatnov vaqti' },
    { field: 'strictly_on_time', headerName: "Qat'iy shu vaqtda" },
    { field: 'price', headerName: 'Narxi' },
    { field: 'address_to_address', headerName: 'Manzilgacha' },
    { field: 'free_seat', headerName: "Bo'sh o'rindiqlar" },
]

axios.get('car-ride').then(({ data }) => pageData.car_rides = data)
</script>