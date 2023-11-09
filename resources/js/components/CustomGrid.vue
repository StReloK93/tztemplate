<template>
    <section>
        <AgGridVue 
            class="h-100 ag-theme-alpine"
            :columnDefs="columnDefs"
            :rowData="gridData.rowData"
            @gridReady="gridReady"
        />
    </section>
</template>

<script setup lang="ts">
import { ColDef } from 'ag-grid-community'
import { reactive } from 'vue'
const { columnDefs, url } = defineProps(['columnDefs', 'url'])

function gridReady(grid){
    console.log(grid)
    
}

const gridData = reactive({
    rowData: null,
})

// const columnDefs: ColDef[] = [
//     { field: '', headerName: 'Transport №', cellRenderer: ({ data }) => `${data.car.type}  ${data.car.number}` },
//     { field: 'start.name', headerName: 'Shahar | A ' },
//     { field: 'end.name', headerName: 'Shahar | B' },
//     { field: 'ride_time', headerName: 'Qatnov vaqti' },
//     { field: 'strictly_on_time', headerName: "Qat'iy shu vaqtda" },
//     { field: 'price', headerName: 'Narxi' },
//     { field: 'address_to_address', headerName: 'Manzilgacha' },
//     { field: 'free_seat', headerName: "Bo'sh o'rindiqlar" },
// ]
</script>