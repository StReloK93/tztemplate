<template>
	<v-card>
		<v-tabs v-model="props.tab">
			<v-tab :to="{ name: 'operator', params: { id: region.id } }" :value="region.id"
				v-for="region in props.regions">
				<span class="tw-text-xs">
					{{ region.name.replace('viloyati', '') }}
				</span>
			</v-tab>
		</v-tabs>
		<section class="pa-4">
			<main v-for="ride in props.carRides">
				{{ ride.cities[0].district.name }}
				{{ ride.cities.at(-1).district.name }}
			</main>
		</section>
	</v-card>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const props = reactive({
	tab: 1,
	regions: null,
	carRides: [],
	districts: null,
})


async function getCarRides(region_id) {
	axios.get(`car-rides/start-region/${region_id}`)
		.then(({ data }) => {
			props.carRides = data.car_rides
			props.districts = data.districts
		})
}
getCarRides(route.params.id)

axios.get('region').then(({ data: regions }) => {
	props.regions = regions
})


watch(route, (current) => {
	getCarRides(current.params.id)
})
</script>