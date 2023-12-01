import CarRideRenderer from '@/components/AgGrid/CarRideRenderer.vue'
import { ColDef } from 'ag-grid-community'
import { CarRide } from '@/interfaces'
export function getColDefs() {
    
    const columnDefs: ColDef<CarRide>[] = [
        {
            cellRenderer: CarRideRenderer,
            flex: 1,
            valueFormatter:  null
        },
        { field: 'ride_time', hide: true },
        { field: 'price', hide: true },
        { field: 'free_seat', hide: true },
    ]

    return columnDefs
}