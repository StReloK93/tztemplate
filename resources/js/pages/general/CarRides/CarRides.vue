<template>
    <main class="d-flex tw-flex-col">
        <Edit @update="onEdit" ref="editComponent"></Edit>
        <div>
            <main class="d-flex align-center justify-space-between mb-2 px-1">
                <v-spacer>
                    <Filters v-if="pageData.gridApi" ref="filterComponent" :pageData="pageData" filter-array="car_rides" />
                </v-spacer>
                <Add></Add>
            </main>
        </div>
        <v-spacer>
            <AgGridVue class="ag-theme-ruzzifer ag-theme-alpine h-100"
                :animateRows="true"
                :defaultColDef="{ sortable: true }"
                :isExternalFilterPresent="() => true"
                :doesExternalFilterPass="doesExternalFilterPass"
                :rowHeight="58"
                :rowClass="pageData.rowClass"
                :columnDefs="columnDefs"
                :rowData="pageData.car_rides"
                :rowSelection="'multiple'"
                @grid-ready="(params) => pageData.gridApi = params.api"
                :getRowId="({ data }) => data.id"
            />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import TransportRenderer from '@/components/AgGrid/TransportRenderer.vue'
import PassengerRenderer from '@/components/AgGrid/PassengerRenderer.vue'
import IconRenderer from '@/components/AgGrid/IconRenderer.vue'
import TimeRenderer from '@/components/AgGrid/TimeRenderer.vue'
import CityRenderer from '@/components/AgGrid/CityRenderer.vue'
import Filters from '@/components/AgGrid/Filter.vue'

import Add from './Add.vue'
import Edit from './Edit.vue'
import { ColDef } from 'ag-grid-community'
import axios from '@/modules/axios'
import { reactive, ref } from 'vue'
import { echo } from '@/modules/echo'

echo.channel('home').listen('NewEvent', (event) => {
	onCreateCarRide(event.msg)
})
const editComponent = ref()
const filterComponent = ref()

const pageData = reactive({
    car_rides: null,
    gridApi: null,
    rowClass: ['tw-max-h-14', 'bg-white', 'tw-shadow']
})

const columnDefs: ColDef[] = [
    { field: 'start', headerName: 'Shahar | A ', cellRenderer: CityRenderer, valueFormatter: null },
    { field: 'end', headerName: 'Shahar | B', cellRenderer: CityRenderer, valueFormatter: null, cellRendererParams: { end: true } },
    { field: 'ride_time', headerName: 'Qatnov vaqti', cellRenderer: TimeRenderer, valueFormatter: null, width: 150 },
    { field: 'price', headerName: 'Narxi', width: 100 },
    { field: 'free_seat', headerName: "Bo'sh o'rindiqlar", cellRenderer: PassengerRenderer, valueFormatter: null, width: 150 },
    { field: '', headerName: 'Transport №', cellRenderer: TransportRenderer, flex: 1, minWidth: 230 },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2', 'hover:tw-bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: IconRenderer,
        cellRendererParams: { icon: 'mdi-pencil-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
            editComponent.value.toggle(data)
        }
    },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2', 'hover:tw-bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: IconRenderer,
        cellRendererParams: { icon: 'mdi-trash-can-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({ data }) => {
            axios.delete(`car-ride/${data.id}`).then(() => {
                pageData.car_rides = pageData.car_rides.filter((ride) => ride.id != data.id)
                pageData.gridApi.applyTransaction({ remove: [data] })
            })
        }
    },
]

function doesExternalFilterPass(node) {
    return filterComponent.value.filters(node)
}


function onCreateCarRide(CarRide) {
    pageData.car_rides.push(CarRide)
    pageData.gridApi.applyTransaction({ add: [CarRide], addIndex: 0 })

    pageData.gridApi.onFilterChanged()
}


function onEdit(CarRide) {
    const rowNode = pageData.gridApi.getRowNode(CarRide.id)
    rowNode.setData(CarRide)
    pageData.gridApi.onFilterChanged()
}

axios.get('car-ride').then(({ data }) => pageData.car_rides = data)
</script>