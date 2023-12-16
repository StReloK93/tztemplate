<template>
    <section class="d-flex w-100">
        <main class="tw-w-1/3 md:tw-w-2/5 lg:tw-w-1/3 bg-pink px-4">
            <v-timeline style="grid-row-gap: 0px;" :truncate-line="'both'" side="end" density="compact" line-color="pink-darken-3">
                <v-timeline-item v-for="(item,index) in carRide.cities" :elevation="2" dot-color="pink-darken-2" size="x-small" fill-dot icon="mdi-record-circle">
                    <div class="tw-leading-none">
                        <div class="text-caption tw-text-red-50">{{ item.district.region.name }}</div>
                        <div class="tw-font-semibold">
                            {{ item.district.name }}
                            <v-btn v-if="carRide.address_to_address && carRide.cities.length - 1 == index" icon="" size="x-small" variant="text">
                                <v-icon color="white">mdi-map-marker</v-icon>
                                <v-tooltip :open-on-click="true" activator="parent" location="bottom">Manzilgacha</v-tooltip>
                            </v-btn>
                        </div>
                    </div>
                </v-timeline-item>
            </v-timeline>
        </main>

        <main class="tw-w-2/3 md:tw-w-3/5 lg:tw-w-2/3 px-4 py-2 d-flex flex-column justify-space-between">
            <section class="flex-grow-1">
                <div class="d-flex justify-space-between">
                    <main class="tw-leading-none">
                        <div class="tw-text-xl">
                            {{ carRide.car.type }} <span class="text-grey-darken-1 tw-text-base">{{ carRide.car.number }}</span> 
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
                        <v-chip size="large" variant="tonal" color="primary" class="tw-font-semibold tw-translate-x-10 pr-8">
                            {{ carRide.price }} so'm
                        </v-chip>
                    </main>
                </div>
            </section>
            <section class="d-flex justify-space-between align-end">
                <div class="tw-leading-4">
                    <p>
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
import moment from '@/modules/moment'
import { CarRide } from '@/interfaces';
const { params } = defineProps(['params'])
const editComponent = params.editComponent
const onDelete = params.onDelete as Function
const carRide = params.data as CarRide

const store = useMainStore()


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
</style>