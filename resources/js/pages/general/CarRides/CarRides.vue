<template>
    <main class="d-flex tw-flex-col">
        <div>
            <h3 class="text-h5 mb-3">Qatnovlar</h3>
            <main class="d-flex align-center justify-space-between">
                <nav></nav>
                <AddCarRide @create="onCreateCarRide"></AddCarRide>
                <EditCarRide @update="onEditCarRide" ref="editComponent"></EditCarRide>
            </main>
        </div>
        <v-spacer>
            <AgGridVue class="ag-theme-ruzzifer h-100" :rowHeight="67" :rowClass="pageData.rowClass"
                :columnDefs="columnDefs" :rowData="pageData.car_rides" :rowSelection="'multiple'"
                @grid-ready="(params) => pageData.gridApi = params.api" :getRowId="({data}) => data.id" />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import IconRenderer from '@/components/IconRenderer.vue'
import AddCarRide from './AddCarRide.vue'
import EditCarRide from './EditCarRide.vue'
import CityRenderer from './CityRenderer.vue'
import TimeRenderer from './TimeRenderer.vue'
import PassengerRenderer from './PassengerRenderer.vue'
import { ColDef } from 'ag-grid-community'
import axios from '@/modules/axios'
import { reactive, ref } from 'vue'
const editComponent = ref()

const pageData = reactive({
    car_rides: null,
    gridApi: null,
    rowClass: ['tw-max-h-16', 'bg-white', 'tw-shadow']
})

const columnDefs: ColDef[] = [
    { field: 'start', headerName: 'Shahar | A ', cellRenderer: CityRenderer, valueFormatter: null },
    { field: 'end', headerName: 'Shahar | B', cellRenderer: CityRenderer, valueFormatter: null , cellRendererParams: { end: true }},
    { field: 'ride_time', headerName: 'Qatnov vaqti', cellRenderer: TimeRenderer, valueFormatter: null, width: 150 },
    { field: 'price', headerName: 'Narxi', width: 100 },
    { field: 'free_seat', headerName: "Bo'sh o'rindiqlar" , cellRenderer: PassengerRenderer, valueFormatter: null, width: 125 },
    { field: '', headerName: 'Transport №', cellRenderer: ({ data }) => `${data.car.type}  ${data.car.number}`, flex: 1 },
    { field: 'phone', headerName: 'Telefon R', width: 130 },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'bg-gray-100'],
        headerName: '',
        width: 80,
        cellRenderer: IconRenderer,
        cellRendererParams: { icon: 'mdi-pencil-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({data}) => {
            editComponent.value.toggle(data)
        }
    },
]


function onCreateCarRide(CarRide){
    pageData.gridApi.applyTransaction({add: [CarRide],addIndex: 0})
}


function onEditCarRide(CarRide){
    const rowNode = pageData.gridApi.getRowNode(CarRide.id)
    rowNode.setData(CarRide)
}

axios.get('car-ride').then(({ data }) => pageData.car_rides = data)
</script>