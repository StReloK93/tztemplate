export interface Dialog {
    model: boolean,
    title: string | null,
    subTitle: string | null,
    open: Function,
    submitInner: Function,
    submit: Function | null,
    cancel: Function,
    reset: Function,
    icon: string,
}


export interface Car{
    id: number,
    user_id: number,
    type: string,
    number: string,
    color: string,
    fuel_type: number,
    fuel: Fuel,
    trunk: boolean,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface Fuel{
    id: number,
    name: string,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface Region{
    id: number,
    name: string,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface Districts{
    id: number,
    region_id: number,
    name: string,
    region: Region,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface CarRide{
    id: number,
    car_id: number,
    car: Car,
    phone: string,
    cities: CarRideCity[],
    start_city: number,
    ride_time: Date,
    strictly_on_time: boolean,
    price: number,
    address_to_address: boolean,
    free_seat: number,
    state: boolean,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface CarRideCity{
    id: number,
    car_ride_id: number,
    district_id: number,
    district: Districts,
    updated_at: Date | null,
    created_at: Date | null,
}

export interface Passenger{
    id?: number,
    name: string,
    phone: string,
    start_city: number,
    start?: Districts,
    start_region?: number,
    end_city: number,
    end?: Districts,
    end_region?: number,
    with_trunk: boolean,
    ride_time: Date | null,
    state?: boolean,
    updated_at?: Date | null,
    created_at?: Date | null,
}