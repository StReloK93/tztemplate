<template>
    <main class="d-flex tw-flex-col">
        <Edit @update="onEdit" ref="editComponent"></Edit>
        <div>
            <main class="d-flex align-center justify-space-between mb-2 px-1">
                <v-spacer>
                    <!-- <Filters v-if="pageData.gridApi" ref="filterComponent" :pageData="pageData" filter-array="passengers" /> -->
                </v-spacer>
                <Add @create="onCreate"></Add>
            </main>
        </div>
        <v-spacer>
            <AgGridVue class="ag-theme-ruzzifer ag-theme-alpine h-100" :rowHeight="58" :rowClass="pageData.rowClass"
                :isExternalFilterPresent="() => true"
                :doesExternalFilterPass="doesExternalFilterPass"
                :columnDefs="columnDefs" :rowData="pageData.passengers" :rowSelection="'multiple'"
                @grid-ready="(params) => pageData.gridApi = params.api" :getRowId="({data}) => data.id" />
        </v-spacer>
    </main>
</template>

<script setup lang="ts">
import TimeRenderer from '@/components/AgGrid/TimeRenderer.vue'
import CityRenderer from '@/components/AgGrid/CityRenderer.vue'
import IconRenderer from '@/components/AgGrid/IconRenderer.vue'
import Filters from '@/components/AgGrid/Filter.vue'
import Add from './Add.vue'
import Edit from './Edit.vue'
import { ColDef, GridApi } from 'ag-grid-community'
import { Passenger } from '@/interfaces'
import { reactive, ref } from 'vue'
const editComponent = ref()
const filterComponent = ref()


interface PageData{
    passengers: Passenger[],
    gridApi: GridApi<Passenger>,
    rowClass: any[],
}
const pageData: PageData = reactive({
    passengers: null,
    gridApi: null,
    rowClass: ['tw-max-h-14', 'bg-white', 'tw-shadow']
})

const columnDefs: ColDef[] = [
    { field: 'start', headerName: 'Shahar | A ', cellRenderer: CityRenderer, valueFormatter: null },
    { field: 'end', headerName: 'Shahar | B', cellRenderer: CityRenderer, valueFormatter: null, cellRendererParams: { end: true } },
    { field: 'ride_time', headerName: 'Qatnov vaqti', cellRenderer: TimeRenderer, valueFormatter: null, width: 150 },
    { field: 'name', headerName: 'F.I.SH', flex: 1, minWidth: 150 },
    { field: 'phone', headerName: 'Raqami', width: 150 },
    { field: 'with_trunk', headerName: "Bagaj bilan", width: 150 },
    {
        cellClass: ['d-flex', 'justify-center', 'align-center', 'px-2' ,'hover:tw-bg-gray-100'],
        headerName: '',
        width: 60,
        cellRenderer: IconRenderer,
        cellRendererParams: { icon: 'mdi-pencil-outline' },
        headerClass: ['px-2'],
        onCellClicked: ({data}) => {
            editComponent.value.toggle(data)
        }
    },
]

function doesExternalFilterPass(node) {
    // filterComponent.value.filters(node)
    return true
}

function onCreate(Transport){
    pageData.gridApi.applyTransaction({add: [Transport],addIndex: 0})
}


function onEdit(Transport){
    const rowNode = pageData.gridApi.getRowNode(Transport.id)
    rowNode.setData(Transport)
}

axios.get<Passenger[]>('passenger').then(({ data }) => pageData.passengers = data)
</script>