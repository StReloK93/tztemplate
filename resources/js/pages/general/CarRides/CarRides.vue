<template>
    <main class="d-flex tw-flex-col tw-max-w-5xl  tw-mx-auto">
        <Edit @update="onEdit" ref="editComponent"></Edit>
        <main class="d-flex align-center justify-space-between tw-w-full">
            <Filters class="w-100" v-if="pageData.gridApi" ref="filterComponent" :pageData="pageData" filter-array="car_rides" />

            <v-btn @click="sortByCountryThenSport" variant="plain" icon="mdi-sort" />
            <Add @create="onCreate"></Add>
        </main>
        <v-spacer>
            <AgGridVue class="ag-theme-ruzzifer ag-theme-alpine h-100" :animateRows="true"
                :defaultColDef="{ sortable: true }" :rowHeight="pageData.rowHeight" :rowClass="pageData.rowClass"
                :headerHeight="0" :columnDefs="colDefs" :rowData="pageData.car_rides" @grid-ready="gridReady"
                :getRowId="({ data }) => data.id" :doesExternalFilterPass="doesExternalFilterPass"
                :isExternalFilterPresent="() => true" />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import { getColDefs } from './GridColumns'
import { GridApi , ColumnApi, ColumnState } from 'ag-grid-community'
import Filters from '@/components/AgGrid/Filter.vue'
import Add from './Add.vue'
import Edit from './Edit.vue'
import { reactive, ref } from 'vue'
import { CarRide } from '@/interfaces'
import { useDisplay } from 'vuetify'
import { watch } from 'vue'
// echo.channel('home').listen('CarRideCreateEvent', (event) => {
//     onCreate(event.msg)
// })
const editComponent = ref()
const filterComponent = ref()
const colDefs = getColDefs(editComponent, onDelete)


let index = 0
const array:any = ['asc', 'desc', null]
const sortByCountryThenSport = () => {
    pageData.columnApi.applyColumnState({
        state: [
            { colId: 'ride_time', sort: array[index], sortIndex: 1 },
        ],
    });
    if(index < 2) index++
    else index = 0
};

interface PageData {
    car_rides: CarRide[] | null,
    gridApi: GridApi<CarRide>,
    columnApi: ColumnApi,
    rowClass: any[],
    rowHeight: number,
}

const pageData: PageData = reactive({
    car_rides: null,
    gridApi: null,
    columnApi: null,
    rowClass: ['car-ride-height', 'tw-shadow-md', 'bg-white', 'rounded-lg', 'overflow-hidden'],
    rowHeight: null,
})

function doesExternalFilterPass(node) {
    return filterComponent.value.filters(node)
}


function onCreate(CarRide) {
    pageData.car_rides.push(CarRide)
    pageData.gridApi.applyTransaction({ add: [CarRide], addIndex: 0 })
    pageData.gridApi.onFilterChanged()
}


function onEdit(CarRide) {
    const rowNode = pageData.gridApi.getRowNode(CarRide.id)
    rowNode.updateData(CarRide);
    pageData.gridApi.onFilterChanged()
}

function onDelete(CarRide) {
    axios.delete(`car-ride/${CarRide.id}`).then(() => {
        pageData.car_rides = pageData.car_rides.filter((ride) => ride.id != CarRide.id)
        pageData.gridApi.applyTransaction({ remove: [CarRide] })
    })
}

axios.get<CarRide[]>('car-ride').then(({ data }) => pageData.car_rides = data)

function setrowHeight(height) {
    pageData.rowHeight = height;
    setTimeout(() => pageData.gridApi.resetRowHeights())
}

const { name } = useDisplay()
const object = {
    xl: 196,
    lg: 196,
    md: 196,
    sm: 196,
    xs: 292,
}
watch(() => name.value, (current) => {
    setrowHeight(object[current])
})

function gridReady(params) {
    pageData.gridApi = params.api
    pageData.columnApi = params.columnApi
    pageData.gridApi.refreshClientSideRowModel()
    pageData.gridApi.redrawRows()
    setrowHeight(object[name.value])
}
</script>