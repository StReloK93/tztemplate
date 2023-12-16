<template>
<v-menu :close-on-content-click="false" location="bottom">
    <template v-slot:activator="{ props }">
        <v-btn color="primary" variant="plain" v-bind="props" icon="mdi-filter-cog-outline" />
    </template>
    <v-card elevation="2" rounded="sm"  :width="300">
        <h3 class="tw-bg-gray-100 px-3 py-2 tw-font-medium">
            Filterlar
        </h3>
        <v-row class="ma-0">
            <v-col cols="12">
                <v-autocomplete
                    label="Shahar | A"
                    v-model="filter.start_city"
                    clearable
                    :items="start_cities"
                    item-title="name"
                    :item-value="(item) => item.id"
                    variant="plain"
                />
            </v-col>
            <v-col cols="12">
                <v-autocomplete
                    label="Shahar | B"
                    v-model="filter.end_city"
                    clearable
                    :items="end_cities"
                    item-title="name"
                    :item-value="(item) => item.id"
                    variant="plain"
                />
            </v-col>
            <v-col cols="12">
                <v-text-field variant="plain" v-model="filter.ride_time" label="Qatnov kuni" type="date"></v-text-field>
            </v-col>
        </v-row>
    </v-card>
</v-menu>
</template>

<script setup lang="ts">
import moment from '@/modules/moment'
import { reactive, computed ,watch } from 'vue'
const { pageData, filterArray } = defineProps(['pageData', 'filterArray'])

const filter = reactive({
    start_city: null,
    end_city: null,
    ride_time: null,
})


const start_cities = computed(() => {
    if(pageData[filterArray] == null) return []
    const array = pageData[filterArray].map((ride) => ride.cities[0].district)
    return array.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.id === value.id
        ))
    )

})

const end_cities = computed(() => {
    if (pageData[filterArray] == null) return []
    const array = []
    pageData[filterArray].forEach(element => {
        element.cities.forEach((item, index) => {
            if(index != 0) array.push(item.district)
        });
    });
    return array.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.id === value.id
        ))
    )
})

function filters(node) {
    // if (filter.start_city == null && filter.end_city == null) return true

    const array = []
    node.data.cities.forEach(((element, index) => {
        if(index != 0) array.push(element.district_id)
    }))
    const start = [null, node.data.cities[0].district_id].includes(filter.start_city)
    const end = [null, ...array].includes(filter.end_city)
    let date;
    if(filter.ride_time == null){
        date = true
    }
    else{
        date = moment(node.data.ride_time).format("YYYY-MM-DD") == moment(filter.ride_time).format("YYYY-MM-DD")
    }
    
    
    // const date = [null, node.data.ride_time].includes(filter.ride_time)
    
    return start && end && date
}
function filterChanged() {
    pageData.gridApi.onFilterChanged()
}

defineExpose({ filters })

watch(() => filter, () => {
    
    filterChanged()
}, {deep:true})
</script>