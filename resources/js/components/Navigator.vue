<template>
    <v-navigation-drawer  v-model="mainStore.menu">
        <v-list class="bg-teal-lighten-5">
            <v-list-item prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg" title="Sandra Adams"
                subtitle="sandra_a88@gmailcom"></v-list-item>
        </v-list>
        <v-divider></v-divider>
        <v-list density="compact">
            <v-list-item prepend-icon="mdi-car-arrow-right" title="Qatnovlar" :to="{name: 'car-rides'}"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
const mainStore = useMainStore()
</script>