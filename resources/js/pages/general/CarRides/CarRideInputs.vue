<template>
    <v-row>
        <v-col cols="12">
            <v-autocomplete :items="pageData.cars" v-model="formData.car" label="Avtomobil"
                :item-title="(item) => item.type + ' ' + item.number" :item-value="(item) => item.id" :rules="rules" />
        </v-col>
        <v-col cols="12" class="py-0 text-center">
            <v-label class="text-caption">
                Boshlangich manzil
            </v-label>
        </v-col>
        <v-col sm="6" cols="12">
            <v-autocomplete @update:model-value="startRegionChanged" :items="pageData.regions"
                v-model="formData.start_region" label="Viloyat" item-title="name" :item-value="(item) => item.id"
                :rules="rules" />
        </v-col>
        <v-col sm="6" cols="12">
            <v-autocomplete :disabled="formData.start_region == null" :items="pageData.start_districts"
                v-model="formData.start_city" label="Shahar (Tuman)" item-title="name" :loading="pageData.start_loading"
                :item-value="(item) => item.id" :rules="rules" />
        </v-col>
        <v-divider class="border-opacity-75"></v-divider>

        <v-col cols="12" class="py-0 text-center">
            <v-label class="text-caption ">
                Boriladigan manzil
            </v-label>
        </v-col>
        <v-col sm="6" cols="12">
            <v-autocomplete @update:model-value="endRegionChanged" :items="pageData.regions" v-model="formData.end_region"
                label="Viloyat" item-title="name" :item-value="(item) => item.id" :rules="rules" />
        </v-col>
        <v-col sm="6" cols="12">
            <v-autocomplete :disabled="formData.end_region == null" :items="pageData.end_districts"
                v-model="formData.end_city" label="Shahar (Tuman)" item-title="name" :item-value="(item) => item.id"
                :loading="pageData.end_loading" :rules="rules" />
        </v-col>
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
import axios from '@/modules/axios'
import { rules } from '@/modules/helpers'
import { reactive } from 'vue'
const { formData } = defineProps(['formData'])
const pageData = reactive({
    cars: [],
    regions: [],
    start_loading: false,
    end_loading: false,
    start_districts: [],
    end_districts: [],
})

function startRegionChanged(item) {
    formData.start_city = null
    pageData.start_loading = true

    axios.get(`district/${item?.id}`).then(({ data }) => {
        pageData.start_districts = data
        setTimeout(() => pageData.start_loading = false, 500)
    })
    .catch(() => {
        setTimeout(() => pageData.start_loading = false, 500)
    })
}

function endRegionChanged(item) {
    formData.end_city = null
    pageData.end_loading = true
    axios.get(`district/${item?.id}`).then(({ data }) => {
        pageData.end_districts = data
        setTimeout(() => pageData.end_loading = false, 500)
    })
    .catch(() => {
        setTimeout(() => pageData.end_loading = false, 500)
    })
}

axios.get('car').then(({ data }) => {
    pageData.cars = data
})

axios.get('region').then(({ data }) => {
    pageData.regions = data
})
</script>