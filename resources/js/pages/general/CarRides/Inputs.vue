<template>
    <v-row>
        <v-col sm="6" cols="12">
            <v-autocomplete
                @update:model-value="setPhone"
                :items="pageData.cars"
                v-model="formData.car_id"
                label="Avtomobil"
                :item-title="(item) => item.type + ' ' + item.number"
                :item-value="(item) => item.id"
                :rules="rules"
            />
        </v-col>
        <v-col sm="6" cols="12">
            <v-text-field
                v-model="formData.phone"
                :step="900"
                label="Telefon raqami"
                :rules="rules"
            />
        </v-col>
        <v-divider class="border-opacity-75"></v-divider>
        <v-col cols="12" class="py-0 text-center">
            <v-label class="text-caption ">
                Boriladigan manzil (Qaerga?)
            </v-label>
        </v-col>
        <template v-for="(city, index) in formData.ends">
            <v-col sm="6" cols="12">
                <v-autocomplete
                    @update:model-value="(id) => regionChanged(id,index)"
                    :items="pageData.regions"
                    label="Viloyat"
                    item-title="name"
                    :item-value="(item) => item.id"
                    :rules="rules"
                />
            </v-col>
            <v-col sm="6" cols="12">
                <v-autocomplete
                    v-model="city.city"
                    :items="city.districts"
                    label="Shahar (Tuman)"
                    item-title="name"
                    :item-value="(item) => item.id"
                    :loading="city.loading"
                    :rules="rules"
                />
            </v-col>
        </template>
        <v-divider class="border-opacity-75"></v-divider>
        <v-col sm="6" cols="12">
            <v-text-field v-model="formData.ride_time" type="datetime-local" :step="900" label="Qatnov vaqti"
                :rules="rules" />
        </v-col>
        <v-col sm="6" cols="12">
            <v-switch v-model="formData.strictly_on_time" label="Qat'iy shu vaqtda"></v-switch>
        </v-col>
        <v-col sm="6" cols="12">
            <v-text-field v-model="formData.price" type="number" label="Narxi" :rules="rules" />
        </v-col>
        <v-col sm="6" cols="12">
            <v-switch v-model="formData.address_to_address" label="Manzilgacha"></v-switch>
        </v-col>
        <v-col sm="6" cols="12">
            <v-text-field v-model="formData.free_seat" type="number" label="Bosh o'rindiqlar" :rules="rules" />
        </v-col>
    </v-row>
</template>

<script setup lang="ts">
import { rules } from '@/modules/helpers'
import { reactive } from 'vue'

const formData = reactive({
    car_id: null,
    phone: null,
    ends: [
        { region: null, city: null, loading: false, districts: [] },
        { region: null, city: null, loading: false, districts: [] },
    ],
    ride_time: null,
    strictly_on_time: false,
    price: null,
    address_to_address: false,
    free_seat: null,
})

const pageData = reactive({
    cars: [],
    regions: [],
})

function setPhone(id){
    const car = pageData.cars.find((car) => car.id == id)
    formData.phone = car.user.phone
}

async function regionChanged(id,index) {
    formData.ends[index].loading = true
    formData.ends[index].city = null
    formData.ends[index].districts = []
    await axios.get(`district/${id}`).then(({ data }) => {
        formData.ends[index].districts = data
        formData.ends[index].loading = false
    })
}

axios.all([axios.get('car'),axios.get('region')])
.then(axios.spread(({data:cars}, {data:regions}) => {
    pageData.cars = cars
    pageData.regions = regions
}))

defineExpose({ regionChanged ,formData })
</script>