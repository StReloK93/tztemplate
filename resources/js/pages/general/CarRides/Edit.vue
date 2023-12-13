<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <CustomForm :submit="submitFunction" title="Mahsulot kiritish" @close="pageData.dialog = false">
            <Inputs ref="inputComponent" :edit="true" />
        </CustomForm>
    </v-dialog>
</template>
<script setup lang="ts">
import { reactive, ref } from 'vue'
import Inputs from './Inputs.vue'
import { CarRide } from '@/interfaces';
const inputComponent = ref()

const emit = defineEmits(['update'])

const pageData = reactive({
    dialog: false,
    car_ride: null
})

async function submitFunction() {
    const formData = inputComponent.value.formData
    await axios.put(`car-ride/${pageData.car_ride.id}`, formData)
        .then(({ data }) => emit('update', data))
}



function getCarRide(id) {
    axios.get<CarRide>(`car-ride/${id}`).then(async ({ data }) => {
        const formData = inputComponent.value.formData
        formData.car_id = data.car_id
        formData.phone = data.phone
        formData.ride_time = data.ride_time
        formData.strictly_on_time = data.strictly_on_time
        formData.price = data.price
        formData.address_to_address = data.address_to_address
        formData.free_seat = data.free_seat
        formData.ends = []
        
        await Promise.all(data.cities.map(async (city, index) => {
            formData.ends.push({ region: null, city: null, loading: false, districts: [] })
            await inputComponent.value.regionChanged(city.district.region_id, index)
            formData.ends[index].region = city.district.region_id
            formData.ends[index].city = city.district_id
            inputComponent.value.clearOverlay()
        }));
        
    })
}



const toggle = (car_ride) => {
    pageData.dialog = true
    pageData.car_ride = car_ride
    getCarRide(car_ride.id)
}
defineExpose({ toggle })
</script>