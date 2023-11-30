<template>
    <main class="d-flex tw-flex-col">
        <Edit @update="onEdit" ref="editComponent"></Edit>
        <div>
            <main class="d-flex align-center justify-space-between mb-2 px-1">
                <v-spacer>
                    <Filters v-if="pageData.gridApi" ref="filterComponent" :pageData="pageData" filter-array="car_rides" />
                </v-spacer>
                <Add @create="onCreate"></Add>
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
                :columnDefs="colDefs"
                :rowData="pageData.car_rides"
                :rowSelection="'multiple'"
                @grid-ready="(params) => pageData.gridApi = params.api"
                :getRowId="({ data }) => data.id"
            />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import { getColDefs } from './GridColumns'
import { GridApi } from 'ag-grid-community'
import Filters from '@/components/AgGrid/Filter.vue'
import Add from './Add.vue'
import Edit from './Edit.vue'
import { reactive, ref } from 'vue'
import { CarRide } from '@/interfaces'
echo.channel('home').listen('CarRideCreateEvent', (event) => {
    onCreate(event.msg)
})

const editComponent = ref()
const filterComponent = ref()

interface PageData{
    car_rides: CarRide[] | null,
    gridApi: GridApi<CarRide>,
    rowClass: any[],
}

const pageData:PageData = reactive({
    car_rides: null,
    gridApi: null,
    rowClass: ['tw-max-h-14', 'bg-white', 'tw-shadow']
})
const colDefs = getColDefs(onDelete, editComponent)

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
    rowNode.setData(CarRide)
    pageData.gridApi.onFilterChanged()
}

function onDelete(CarRide) {
    axios.delete(`car-ride/${CarRide.id}`).then(() => {
        pageData.car_rides = pageData.car_rides.filter((ride) => ride.id != CarRide.id)
        pageData.gridApi.applyTransaction({ remove: [CarRide] })
    })
}

axios.get<CarRide[]>('car-ride').then(({ data }) => pageData.car_rides = data)
</script>