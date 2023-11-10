<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <CustomForm :submit="submitFunction" title="Mahsulot kiritish" @close="pageData.dialog = false">
            <CarRideInputs :form-data="formData" />
        </CustomForm>
    </v-dialog>
</template>
<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import CustomForm from '@/components/Form.vue'
import CarRideInputs from './CarRideInputs.vue'



const emit = defineEmits(['update'])
const formData = reactive({
    car: null,
    start_region: null,
    start_city: null,
    end_region: null,
    end_city: null,
    ride_time: null,
    strictly_on_time: false,
    price: null,
    address_to_address: false,
    free_seat: null,
})

const pageData = reactive({dialog: false})

async function submitFunction() {
    await axios.post('car-ride', formData).then(({data}) => emit('update', data))
}

function getCarRide(id){
    axios.get(`car-ride/${id}`).then(({ data }) => {
        console.log(data)
        
        formData.car = data.car
        formData.start_region = data.start_region
        formData.start_city = data.start_city
        formData.end_region = data.end_region
        formData.end_city = data.end_city
        formData.ride_time = data.ride_time
        formData.strictly_on_time = Boolean(data.strictly_on_time)
        formData.price = data.price
        formData.address_to_address = Boolean(data.address_to_address)
        formData.free_seat = data.price
    })
}

const toggle = (car_ride) => {
    pageData.dialog = true
    getCarRide(car_ride.id)
}
defineExpose({ toggle })
</script>