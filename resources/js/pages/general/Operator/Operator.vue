<template>
	<v-card>
		<v-tabs v-model="props.tab">
			<v-tab :to="{name: 'operator', params: {id: region.id}}" :value="region.id" v-for="region in props.regions">
				<span class="tw-text-xs">
					{{region.name.replace('viloyati', '')}}
				</span>
			</v-tab>
		</v-tabs>
		
	</v-card>
</template>

<script setup lang="ts">
import { reactive, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const props = reactive({
	tab: 1,
	regions: null,
})

axios.get('region').then(({data:regions}) => {
	props.regions = regions
})


watch(route, (current, old) => {
	console.log(current, +route.params.id)
	route.params.id
	
})
</script>