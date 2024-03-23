<template>
	<v-row>
		<v-overlay v-if="edit" v-model="pageData.overlay" contained persistent class="align-center justify-center">
			<v-progress-circular color="primary" indeterminate :size="68"></v-progress-circular>
		</v-overlay>
		<v-col sm="6" cols="12">
			<v-autocomplete @update:model-value="setPhone" :items="pageData.cars" v-model="formData.car_id"
				label="Avtomobil" :item-title="(item) => item.type + ' ' + item.number" :item-value="(item) => item.id"
				:rules="rules" />
		</v-col>
		<v-col sm="6" cols="12">
			<v-text-field v-model="formData.phone" :step="900" label="Telefon raqami" :rules="rules" />
		</v-col>
		<v-divider class="border-opacity-75"></v-divider>
		<template v-for="(city, index) in formData.ends">
			<v-col v-if="index == 0" cols="12" class="py-2 text-center">
				<v-label class="text-caption  mr-3">
					Boshlang'ich manzil (Qaerdan?)
				</v-label>
				<v-btn size="x-small" @click="addCity" :disabled="formData.ends.length == 4" icon="mdi-plus"
					variant="plain"></v-btn>
			</v-col>
			<v-col v-if="[1].includes(index) && index != formData.ends.length - 1" cols="12" class="py-0 text-center">
				<v-label class="text-caption ">
					Oraliq manzillar
				</v-label>
			</v-col>
			<v-col v-if="formData.ends.length == index + 1" cols="12" class="py-0 text-center">
				<v-label class="text-caption">
					Boriladigan manzil (Qaerga?)
				</v-label>
			</v-col>
			<div class="w-100 d-flex flex-wrap"
				:class="{ 'px-0': [1, 2].includes(index) && index != formData.ends.length - 1 }">
				<v-col sm="6" cols="12">
					<v-autocomplete v-model="city.region" @update:model-value="(id) => regionChanged(id, index)"
						:items="pageData.regions" label="Viloyat" item-title="name" :item-value="(item) => item.id"
						:rules="rules" />
				</v-col>
				<v-col sm="6" cols="12" class="d-flex align-center">
					<v-autocomplete :disabled="city.region == null" v-model="city.city" :items="city.districts"
						label="Shahar (Tuman)" item-title="name" :item-value="(item) => item.id" :loading="city.loading"
						:rules="rules" />
					<v-btn @click="removeCity(index)" size="x-small" icon="mdi-minus" class="ml-2" variant="plain"
						v-if="[1, 2].includes(index) && index != formData.ends.length - 1" />
				</v-col>
			</div>
		</template>
		<v-divider class="border-opacity-75"></v-divider>
		<v-col sm="6" cols="12">
			<VDatePicker
				color="pink"
				:min-date="new Date()"
				v-model.string="formData.ride_time"
				:masks="{modelValue: 'YYYY-MM-DD HH:mm'}"
				mode="datetime"
				transparent
				borderless
				expanded
				is24hr
				is-required
			/>
			<div v-if="dateIsset" class="v-messages text-error font-weight-regular pb-2 !tw-opacity-100">
				<div class="v-messages__message">To'ldiring</div>
			</div>
		</v-col>
		<v-col sm="6" cols="12">
			<v-text-field label="Narxi" :rules="rules" v-model.lazy="formData.price" class="mb-3" />
			<v-text-field v-model="formData.free_seat" type="number" label="Bosh o'rindiqlar" class="mb-3" :rules="rules" />
			<input v-money3="config" v-model.lazy="formData.price" type="text" hidden>
			<v-switch v-model="formData.strictly_on_time" label="Qat'iy shu vaqtda"></v-switch>
			<v-switch v-model="formData.address_to_address" label="Manzilgacha"></v-switch>
		</v-col>
	</v-row>
</template>

<script setup lang="ts">
import config from '@/modules/moneyConfig'
import { rules } from '@/modules/helpers'
import { reactive,ref } from 'vue'
const { edit } = defineProps(['edit'])
const dateIsset = ref(false)

const formData = reactive({
	car_id: null,
	phone: null,
	strictly_on_time: false,
	address_to_address: true,
	ends: [
		{ region: null, city: null, loading: false, districts: [] },
		{ region: null, city: null, loading: false, districts: [] },
	],
	ride_time: null,
	price: "",
	free_seat: null,
})

const pageData = reactive({
	overlay: true,
	cars: [],
	regions: [],
})

function addCity() {
	if (formData.ends.length == 4) return
	formData.ends.splice(1, 0, { region: null, city: null, loading: false, districts: [] });
}

function removeCity(index) {
	formData.ends.splice(index, 1);
}

function setPhone(id) {
	const car = pageData.cars.find((car) => car.id == id)
	formData.phone = car.user.phone
}

async function regionChanged(id, index) {
	formData.ends[index].loading = true
	formData.ends[index].city = null
	formData.ends[index].districts = []
	await axios.get(`district/${id}`).then(({ data }) => {
		formData.ends[index].districts = data
		formData.ends[index].loading = false
	})
}

function datePicked(){
	if(formData.ride_time == null) dateIsset.value = true
}


function clearOverlay() {
	pageData.overlay = false
}

axios.all([axios.get('car'), axios.get('region')])
	.then(axios.spread(({ data: cars }, { data: regions }) => {
		pageData.cars = cars
		pageData.regions = regions
	}))

defineExpose({ regionChanged, formData, clearOverlay, datePicked })
</script>