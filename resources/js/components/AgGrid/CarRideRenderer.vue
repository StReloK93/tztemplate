<template>
    <section class="d-flex w-100">
        <main class="tw-w-1/3 md:tw-w-2/5 lg:tw-w-1/3 bg-pink px-4">
            <v-timeline style="grid-row-gap: 0px;" :truncate-line="'both'" side="end" density="compact"
                line-color="pink-darken-3">
                <v-timeline-item elevation="2" dot-color="pink-darken-2" size="x-small" fill-dot icon="mdi-record-circle">
                    <div class="tw-leading-none">
                        <div class="text-caption tw-text-red-50">{{ params.data.start.region.name }}</div>
                        <div class="tw-font-semibold">{{ params.data.start.name }}</div>
                    </div>
                </v-timeline-item>
                <!-- <v-timeline-item elevation="2" dot-color="pink-darken-2" size="x-small" fill-dot icon="mdi-record-circle">
                    <div class="tw-leading-none">
                        <div class="text-caption tw-text-red-200">{{ params.data.start.region.name }}</div>
                        <div class="tw-font-semibold">{{ params.data.start.name }}</div>
                    </div>
                </v-timeline-item>
                <v-timeline-item elevation="2" dot-color="pink-darken-2" size="x-small" fill-dot icon="mdi-record-circle">
                    <div class="tw-leading-none">
                        <div class="text-caption tw-text-red-200">{{ params.data.start.region.name }}</div>
                        <div class="tw-font-semibold">{{ params.data.start.name }}</div>
                    </div>
                </v-timeline-item> -->
                <v-timeline-item elevation="2" dot-color="pink-darken-2" size="x-small" fill-dot icon="mdi-record-circle">
                    <div class="tw-leading-none">
                        <div class="text-caption tw-text-red-50">{{ params.data.start.region.name }}</div>
                        <div class="tw-font-semibold">{{ params.data.start.name }}</div>
                    </div>
                </v-timeline-item>
            </v-timeline>
        </main>

        <main class="tw-w-2/3 md:tw-w-3/5 lg:tw-w-2/3 px-4 py-2 d-flex flex-column justify-space-between">
            <section class="flex-grow-1">
                <div class="d-flex justify-space-between">
                    <main></main>
                    <main>
                        <v-chip size="large" variant="tonal" color="primary" class="tw-font-semibold tw-translate-x-10 pr-8">
                            {{ params.data.price }} so'm
                        </v-chip>
                    </main>
                </div>
            </section>
            <section class="d-flex justify-space-between align-end">
                <div class="tw-leading-4">
                    <p>{{ moment(params.data.ride_time).format('HH:mm') }}</p>
                    <span class="tw-uppercase tw-text-2xl tw-font-semibold tw-text-gray-600">{{
                        moment(params.data.ride_time).format('D-MMMM') }}</span>
                </div>
                <div>
                    <v-btn size="small" @click="editComponent.toggle(params.data)" variant="plain" icon="mdi-pencil" />
                    <v-btn size="small" @click="carDelete" variant="plain" icon="mdi-delete" class="ml-3" />
                </div>
            </section>
        </main>
    </section>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
import { inject, Ref } from 'vue'
import moment from '@/modules/moment'
const editComponent: Ref = inject('editComponent')
const onDelete: Function = inject('onDelete')
const { params } = defineProps(['params'])
console.log(params)

const store = useMainStore()


function carDelete() {
    store.dialog.open(() => {
        store.dialog.title = "Qatnovni o'chirmoqchimisiz ?"
        store.dialog.subTitle = "O'chirilgan qatnovlar savatchada 1 oy muddat saqlanadi.",
            store.dialog.submit = () => onDelete(params.data)
    })
}
</script>

<style>
.v-timeline .v-timeline-divider__dot {
    background: none;
}
</style>