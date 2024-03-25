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
		<section>
			<main v-for="(districts, name) in groupRides">
				<div class="tw-bg-gray-100 px-4 py-1">
					{{ name }}
				</div>
				<article class="d-flex">
					<aside v-for="(endpoint, city_id) in districts" class="tw-w-1/6 px-2 tw-border-r">
						<div class="">
							<header class="text-center text-pink tw-font-medium tw-text-sm tw-py-1.5">
								{{ city_id }}
							</header>
							<footer>
								<div v-for="ride in endpoint" class="py-1 tw-bg-gray-100 px-2 mb-1">
									{{ ride.car.type }} {{ ride.free_seat }}
								</div>
							</footer>
						</div>
					</aside>
				</article>
			</main>
		</section>
	</v-card>
</template>

<script setup lang="ts">
import { reactive, watch, computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const props = reactive({
	tab: 1,
	regions: null,
	carRides: [],
	districts: null,
})

const groupRides:any = computed(() => {
	const dists = {}
	props.districts?.forEach(district => {
		props.carRides.forEach((ride) => {

			if (district.id == ride.cities[0].district_id) {
				const group = `${ride.cities.at(-1).district.region.name} ${ride.cities.at(-1).district.name}`
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
	console.log(dists);
	
	return dists
})

async function getCarRides(region_id) {
	axios.get(`car-rides/start-region/${region_id}`)
		.then(({ data }) => {
			props.carRides = data.car_rides
			props.districts = data.districts
			console.log(data.districts)
			
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