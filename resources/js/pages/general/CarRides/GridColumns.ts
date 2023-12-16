import CarRideRenderer from '@/components/AgGrid/CarRideRenderer.vue'
import { ColDef } from 'ag-grid-community'
import { CarRide } from '@/interfaces'
export function getColDefs(editComponent, onDelete) {
    
    const columnDefs: ColDef<CarRide>[] = [
        {
            cellRenderer: CarRideRenderer,
            cellRendererParams: {editComponent, onDelete},
            flex: 1,
            valueFormatter:  null,
            cellClass: ['px-0', 'align-stretch']
        },
        { field: 'ride_time', hide: true },
        { field: 'price', hide: true },
        { field: 'free_seat', hide: true },
    ]

    return columnDefs
}