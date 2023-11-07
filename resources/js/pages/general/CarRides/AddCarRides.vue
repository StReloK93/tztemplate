<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" />
        </template>
        <CustomForm :submit="submitFunction" title="Mahsulot kiritish" @close="pageData.dialog = false">
            <v-row>
                <v-col cols="12">
                    <v-autocomplete density="compact" :items="pageData.cars" v-model="formData.car" label="Avtomobil"
                        :item-title="(item) => item.type + ' ' + item.number" :item-value="(item) => item" :rules="rules" />
                </v-col>
                <v-col cols="12" class="py-0">
                    <v-label>
                        Boshlangich manzil
                    </v-label>
                </v-col>
                <v-col cols="6">
                    <v-autocomplete density="compact" @update:model-value="startRegionChanged" :items="pageData.regions"
                        v-model="formData.start_region" label="Viloyat" item-title="name" :item-value="(item) => item"
                        :rules="rules" />
                </v-col>
                <v-col cols="6">
                    <v-autocomplete density="compact" :items="pageData.start_districts" v-model="formData.start_city" label="Shahar (Tuman)"
                        item-title="name" :item-value="(item) => item" :rules="rules" />
                </v-col>
                <v-col cols="12" class="py-0">
                    <v-label>
                        Boriladigan manzil
                    </v-label>
                </v-col>
                <v-col cols="6">
                    <v-autocomplete density="compact" @update:model-value="endRegionChanged" :items="pageData.regions"
                        v-model="formData.end_region" label="Viloyat" item-title="name" :item-value="(item) => item"
                        :rules="rules" />
                </v-col>
                <v-col cols="6">
                    <v-autocomplete density="compact" :items="pageData.end_districts" v-model="formData.end_city" label="Shahar (Tuman)"
                        item-title="name" :item-value="(item) => item" :rules="rules" />
                </v-col>

                <v-col cols="6">
                    <v-text-field type="time" step="900" label="Qatnov vaqti" :rules="rules"/>
                </v-col>
                <v-col cols="6">
                    <v-switch label="Qat'iy shu vaqtda"></v-switch>
                </v-col>
                <v-col cols="6">
                    <v-text-field type="number" label="Narxi" :rules="rules"/>
                </v-col>
                <v-col cols="6">
                    <v-switch label="Manzilgacha"></v-switch>
                </v-col>
                <v-col cols="6">
                    <v-text-field type="number" label="Bosh o'rindiqlar" :rules="rules"/>
                </v-col>
            </v-row>
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import axios from '@/modules/axios'
import CustomForm from '@/components/Form.vue'
import { rules } from '@/modules/helpers'

const formData = reactive({
    car: null,
    start_region: null,
    start_city: null,
    end_region: null,
    end_city: null,
})

const pageData = reactive({
    dialog: false,
    loading: false,
    cars: null,
    regions: null,
    start_districts: [],
    end_districts: [],

})

function startRegionChanged(item) {
    formData.start_city = null
    axios.get(`district/${item.id}`).then(({ data }) => {
        pageData.start_districts = data
    })
}

function endRegionChanged(item) {
    formData.end_city = null
    axios.get(`district/${item.id}`).then(({ data }) => {
        pageData.end_districts = data
    })
}


function submitFunction() {

}

axios.get('car').then(({ data }) => {
    pageData.cars = data
})

axios.get('region').then(({ data }) => {
    pageData.regions = data
})

</script>