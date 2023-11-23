<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <CustomForm :submit="submitFunction" title="Mahsulot kiritish" @close="pageData.dialog = false">
            <Inputs ref="inputComponent" />
        </CustomForm>
    </v-dialog>
</template>
<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
import Inputs from './Inputs.vue'
const inputComponent = ref()

const emit = defineEmits(['update'])

const pageData = reactive({
    dialog: false,
    car_ride: null
})

async function submitFunction() {
    const formData = inputComponent.value.formData
    await axios.put(`car-ride/${pageData.car_ride.id}`, formData)
    .then(({data}) => emit('update', data))
}



function getCarRide(id){
    axios.get(`car-ride/${id}`).then(({ data }) => {
        const formData = inputComponent.value.formData
        formData.car_id = data.car_id
        formData.phone = data.phone
        formData.start_region = data.start.region_id
        formData.end_region = data.end.region_id
        formData.ride_time = data.ride_time
        formData.strictly_on_time = data.strictly_on_time
        formData.price = data.price
        formData.address_to_address = data.address_to_address
        formData.free_seat = data.free_seat

        inputComponent.value.regionChanged(formData.start_region,'start')
        .then(() => formData.start_city = data.start_city)
        inputComponent.value.regionChanged(formData.end_region,'end')
        .then(() => formData.end_city = data.end_city)
    })
}

const toggle = (car_ride) => {
    pageData.dialog = true
    pageData.car_ride = car_ride
    getCarRide(car_ride.id)
}
defineExpose({ toggle })
</script>