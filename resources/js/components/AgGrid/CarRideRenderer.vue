<template>
    <section class="d-flex w-100 tw-flex-col sm:tw-flex-row">
        <main class="sm:tw-w-1/3 md:tw-w-2/5 lg:tw-w-1/3 bg-pink px-4 tw-h-20 sm:tw-h-[initial] d-flex align-center">
            <v-timeline :direction="direction" style="grid-row-gap: 0px;" truncate-line="both" side="end" density="compact"
                line-color="pink-darken-3">
                <v-timeline-item v-for="(item, index) in carRide.cities" :dot-color="dotColor(index)" size="x-small"
                    fill-dot icon="mdi-record-circle">
                    <template v-if="middleLocation(index) == false" v-slot:icon>
                        <v-btn icon=""
                                size="x-small" variant="text">
                                <v-icon color="white">mdi-record-circle</v-icon>
                                <v-tooltip :open-on-click="true" activator="parent"
                                    location="bottom">{{item.district.name}}</v-tooltip>
                            </v-btn>
                    </template>
                    <div class="tw-leading-none">
                        <div v-if="middleLocation(index)" class="text-caption tw-text-red-50 tw-text-center sm:tw-text-left">
                            {{ item.district.region.name}}
                        </div>
                        <div v-if="middleLocation(index)" class="tw-font-semibold">
                            {{ item.district.name }}
                            <v-btn v-if="carRide.address_to_address && carRide.cities.length - 1 == index" icon=""
                                size="x-small" variant="text">
                                <v-icon color="white">mdi-map-marker</v-icon>
                                <v-tooltip :open-on-click="true" activator="parent"
                                    location="bottom">Manzilgacha</v-tooltip>
                            </v-btn>
                        </div>
                    </div>
                </v-timeline-item>
            </v-timeline>
        </main>

        <main
            class="sm:tw-w-2/3 md:tw-w-3/5 lg:tw-w-2/3 px-4 py-2 d-flex flex-column justify-space-between tw-flex-grow sm:tw-flex-grow-0">
            <section class="flex-grow-1">
                <div class="d-flex justify-space-between">
                    <main class="tw-leading-none">
                        <div class="tw-text-xl">
                            {{ carRide.car.type }} <span class="text-grey-darken-1 tw-text-base">{{ carRide.car.number
                            }}</span>
                        </div>
                        <div class="py-1 tw-text-gray-500">
                            <a :href="`tel:${carRide.phone}`">{{ carRide.phone }}</a>
                        </div>
                        <div class="py-1 text-primary">
                            {{ carRide.car.fuel.name }}
                        </div>
                    </main>
                    <main>
                        <div class="text-right tw-leading-none">
                            <p class="mb-3 tw-text-gray-500">Bosh o'rindiqlar</p>
                            <v-icon v-for="n in carRide.free_seat" color="pink">
                                mdi-account-settings
                            </v-icon>
                        </div>
                        <v-chip size="large" variant="tonal" color="primary"
                            class="tw-font-semibold tw-translate-x-10 pr-8">
                            {{ format(carRide.price, moneyConfig) }} so'm
                        </v-chip>
                    </main>
                </div>
            </section>
            <section class="d-flex justify-space-between align-end">
                <div class="tw-leading-4">
                    <p class="tw-text-gray-500">
                        {{ moment(carRide.ride_time).format('HH:mm') }}
                    </p>
                    <span class="tw-uppercase tw-text-2xl tw-font-semibold tw-text-gray-600 tw-inline-flex tw-items-center">
                        {{ moment(carRide.ride_time).format('D-MMMM') }}
                        <v-btn v-if="carRide.strictly_on_time" icon="" size="x-small" variant="text">
                            <v-icon>mdi-book-clock</v-icon>
                            <v-tooltip activator="parent" location="bottom">Qat'iy shu vaqtda</v-tooltip>
                        </v-btn>
                    </span>
                </div>
                <div>
                    <v-btn size="small" @click="editComponent.toggle(carRide)" variant="plain" icon="mdi-pencil" />
                    <v-btn size="small" @click="carDelete" variant="plain" icon="mdi-delete" class="ml-3" />
                </div>
            </section>
        </main>
    </section>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
import { format } from 'v-money3'
import moneyConfig from '@/modules/moneyConfig'
import moment from '@/modules/moment'
import { computed } from 'vue'
import { CarRide } from '@/interfaces'
import { useDisplay } from 'vuetify'

const { mobile } = useDisplay()
const { params } = defineProps(['params'])
const editComponent = params.editComponent
const onDelete = params.onDelete as Function
const carRide = params.data as CarRide

const store = useMainStore()
const direction = computed(() => {
    return mobile.value ? 'horizontal' : 'vertical'
})

const dotColor = (index) => {
    return [0, carRide.cities.length - 1].includes(index) ? 'pink-darken-2' : 'transparent'
}

const middleLocation = (index) => {
    return [0, carRide.cities.length - 1].includes(index) == true
}

function carDelete() {
    store.dialog.open(() => {
        store.dialog.title = "Qatnovni o'chirmoqchimisiz ?"
        store.dialog.subTitle = "O'chirilgan qatnovlar savatchada 1 oy muddat saqlanadi.",
            store.dialog.submit = () => onDelete(carRide)
    })
}
</script>

<style>
.v-timeline .v-timeline-divider__dot {
    background: none;
}

.v-timeline--horizontal.v-timeline {
    grid-column-gap: 10px;
}

.v-timeline--horizontal {
    overflow: hidden;
    overflow-x: auto;
}

.v-timeline--horizontal::-webkit-scrollbar {
    display: block;
    width: 5px;
}

.v-timeline--horizontal::-webkit-scrollbar-track {
    background: transparent;
}

.v-timeline--horizontal::-webkit-scrollbar-thumb {
    background-color: transparent;
    border-right: none;
    border-left: none;
}</style>