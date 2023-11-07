<template>
    <v-navigation-drawer>
        <v-list >
            <v-list-item prepend-icon="mdu-book" title="Aziz Soliyev"
                subtitle="+9989 93 660 09 60"></v-list-item>
        </v-list>
        <v-divider></v-divider>
        <v-list density="compact">
            <v-list-item prepend-icon="mdi-car-arrow-right" title="Qatnovlar" :to="{name: 'car-rides'}"></v-list-item>
        </v-list>
        <v-list density="compact">
            <v-list-item prepend-icon="mdi-train-car" title="Transportlar" :to="{name: 'transports'}"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
const mainStore = useMainStore()
</script>