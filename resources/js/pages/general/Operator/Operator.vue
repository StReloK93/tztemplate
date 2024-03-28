<template>
	<v-card>
		<v-tabs v-model="props.tab">
			<v-tab :to="{ name: 'operator', params: { id: region.id } }" :value="region.id" v-for="region in props.regions">
				<span class="tw-text-xs">
					{{ region.name.replace('viloyati', '') }}
				</span>
			</v-tab>
		</v-tabs>
		<section>
			<Add />
			<!--  -->
			<CarRideModal ref="rideModal" />
			<!--  -->
			<v-expansion-panels v-model="props.panel" multiple variant="accordion">
				<v-expansion-panel v-for="(districts, name) in groupRides">
					<v-expansion-panel-title>{{ name }}</v-expansion-panel-title>
					<v-expansion-panel-text class="operator">
						<article class="d-flex">
							<aside v-for="(endpoint, key) in districts" class="tw-w-1/5 px-2 tw-border-r tw-shadow-inner">
								<div>
									<header class="text-center text-pink tw-font-medium tw-text-sm tw-py-2 mb-2">
										<span>{{ name }}</span>
										- {{ trueNameCity(key) }}
									</header>
									<footer>
										<CarRideCard @click="rideModal.openModal(ride.id)" v-for="ride in endpoint" :ride="ride" />
									</footer>
								</div>
							</aside>
						</article>
					</v-expansion-panel-text>
				</v-expansion-panel>
			</v-expansion-panels>
		</section>
	</v-card>
</template>

<script setup lang="ts">
import { reactive, watch, computed, ref } from 'vue'
import { useRoute } from 'vue-router'
import CarRideModal from './CarRideModal.vue'
import CarRideCard from './CarRideCard.vue'
import Add from '@/pages/general/CarRides/Add.vue'
const rideModal = ref()
const route = useRoute()
const props = reactive({
	tab: 1,
	regions: null,
	carRides: [],
	districts: null,
	panel: 0,
})

const groupRides: any = computed(() => {
	const dists = {}
	props.districts?.forEach(district => {
		props.carRides.forEach((ride) => {

			if (district.id == ride.cities[0].district_id) {
				let group = `${ride.cities.at(-1).district.region.name} ${ride.cities.at(-1).district.name}`
				const array = group.split(' ');
				if (hasDuplicates(array)) {
					group = ride.cities.at(-1).district.name
				}


				if (dists[district.name]) {

					if (dists[district.name][group]) {
						dists[district.name][group].push(ride)
					}
					else {
						dists[district.name][group] = [ride]
					}
				}
				else {
					dists[district.name] = {}
					dists[district.name][group] = [ride]
				}
			}

		})
	})
	return dists
})

async function getCarRides(region_id) {
	axios.get(`car-rides/start-region/${region_id}`)
		.then(({ data }) => {
			props.carRides = data.car_rides
			props.districts = data.districts
		})
}
getCarRides(route.params.id)
axios.get('region').then(({ data }) => props.regions = data)


function hasDuplicates(array) {
	return (new Set(array)).size !== array.length;
}
function trueNameCity(name) {
	return name.replace("viloyati", ".V")
}

watch(route, (current) => {
	getCarRides(current.params.id)
	props.panel = null
})
</script>