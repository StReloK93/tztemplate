<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" />
        </template>
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
const emit = defineEmits(['create'])
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
    await axios.post('car-ride', formData).then(({data}) => {
        emit('create', data)
    })
}
</script>