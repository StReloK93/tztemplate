<template>
<v-menu :close-on-content-click="false" location="bottom">
    <template v-slot:activator="{ props }">
        <main>
            <v-btn color="primary" variant="text" v-bind="props" prepend-icon="mdi-filter">
                Filterlar
            </v-btn>
            <v-btn v-if="filtered == false" color="primary" size="x-small" variant="text" @click="resetFilter" icon="mdi-close" />
        </main>
    </template>
    <v-card elevation="2" rounded="sm"  :width="280">
        <v-row class="ma-0">
            <v-col cols="12">
                <v-autocomplete
                    label="Shahar | A"
                    v-model="filter.start_city"
                    clearable
                    :items="start_cities"
                    item-title="name"
                    :item-value="(item:any) => item.id"
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
                    :item-value="(item:any) => item.id"
                    variant="plain"
                />
            </v-col>
            <v-col cols="12" class="d-flex align-center flex-column py-0">
                <VDatePicker
                    :min-date="new Date()"
                    v-model="filter.ride_time"
                    mode="date"
                    transparent
                    borderless
                    expanded
                />
            </v-col>
        </v-row>
    </v-card>
</v-menu>
</template>

<script setup lang="ts">
import moment from '@/modules/moment'
import { reactive, computed , watch, ref } from 'vue'
const { pageData, filterArray } = defineProps(['pageData', 'filterArray'])
const filter = reactive({start_city: null, end_city: null, ride_time: null})

// const attributes = ref([
//   {
//     highlight: true,
//     dates: {
//       start: new Date(),
//     },
//   },
// ]);
const dates = ref({ start: new Date() })

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
    const selectedDate = filter.ride_time == null ? null : moment(filter.ride_time).format("YYYY-MM-DD")
    // Start City
    const start = [null, node.data.cities[0].district_id].includes(filter.start_city)

    // End Cities
    const array = node.data.cities.filter((item, index) => index != 0).map((item) => item.district_id)
    const end = [null, ...array].includes(filter.end_city)
    // Selected Date
    const date = [moment(node.data.ride_time).format("YYYY-MM-DD"), null].includes(selectedDate)
    
    return start && end && date
}

const filtered = computed(() => {
    const array = Object.values(filter)
    return array.every((item) => [null, ""].includes(item))
})
function resetFilter() {
    filter.start_city = null
    filter.end_city = null
    filter.ride_time = null
}
defineExpose({ filters, resetFilter, filtered })
watch(() => filter, () => pageData.gridApi.onFilterChanged(), {deep:true})
</script>

