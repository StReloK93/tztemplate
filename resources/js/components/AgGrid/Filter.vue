<template>
    <v-row>
        <v-col cols="12" md="3" class="py-1">
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
        <v-col cols="12" md="3" class="py-1">
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
    </v-row>
</template>

<script setup lang="ts">
import { reactive, computed ,watch } from 'vue'
const { pageData, filterArray } = defineProps(['pageData', 'filterArray'])
const filter = reactive({
    start_city: null,
    end_city: null,
    ride_time: null,
})


const start_cities = computed(() => {
    if(pageData[filterArray] == null) return []
    const array = pageData[filterArray].map((ride) => ride.start)
    return array.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.id === value.id
        ))
    )

})

const end_cities = computed(() => {
    if(pageData[filterArray] == null) return []
    const array = pageData[filterArray].map((ride) => ride.end)
    return array.filter((value, index, self) =>
        index === self.findIndex((t) => (
            t.id === value.id
        ))
    )
})

function filters(node) {
    if (filter.start_city == null && filter.end_city == null) return true
    const start = [null, node.data.start_city].includes(filter.start_city)
    const end = [null, node.data.end_city].includes(filter.end_city)
    const date = [null, node.data.ride_time].includes(filter.ride_time)
    
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