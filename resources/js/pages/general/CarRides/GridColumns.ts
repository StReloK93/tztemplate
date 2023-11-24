import TransportRenderer from '@/components/AgGrid/TransportRenderer.vue'
import PassengerRenderer from '@/components/AgGrid/PassengerRenderer.vue'
import IconRenderer from '@/components/AgGrid/IconRenderer.vue'
import TimeRenderer from '@/components/AgGrid/TimeRenderer.vue'
import CityRenderer from '@/components/AgGrid/CityRenderer.vue'
import { ColDef } from 'ag-grid-community'

export function getColDefs(onDelete, editComponent) {
    
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
                onDelete(data)
            }
        },
    ]

    return columnDefs
}

