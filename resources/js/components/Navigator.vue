<template>
    <v-navigation-drawer color="">
        <main class="d-flex tw-justify-center py-2 tw-bg-slate-100">
            <v-list-item prepend-avatar="/icon.png"/>
        </main>
        <v-divider></v-divider>
        <v-list density="compact">
            <v-list-item prepend-icon="mdi-home" title="Bosh sahifa" color="primary" :to="{name: 'home'}"/>
            <v-list-item prepend-icon="mdi-vector-line" title="Qatnovlar" color="primary" :to="{name: 'car-rides'}"/>
            <v-list-item prepend-icon="mdi-train-car" title="Transportlar" color="primary" :to="{name: 'transports'}"/>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
const mainStore = useMainStore()
</script>