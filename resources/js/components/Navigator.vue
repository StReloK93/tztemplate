<template>
    <v-navigation-drawer :temporary="name == 'sm'" v-model="mainStore.menu">
        <main class="d-flex tw-justify-center py-4 tw-bg-slate-100">
            <v-icon color="primary" size="34">mdi-vuetify</v-icon>
        </main>
        <v-divider></v-divider>
        <div>
            <v-list density="compact">
                <v-list-item prepend-icon="mdi-vector-line" title="Qatnovlar" color="primary"
                    :to="{ name: 'car-rides' }" />
                <v-list-item prepend-icon="mdi-account-convert" title="Yo'lovchilar" color="primary"
                    :to="{ name: 'passengers' }" />
            </v-list>
            <v-divider class="border-opacity-50"></v-divider>
            <v-list density="compact">
                <v-list-item prepend-icon="mdi-train-car" title="Transportlar" color="primary"
                    :to="{ name: 'transports' }" />
            </v-list>
        </div>
        <template v-slot:append>
            <div class="pa-2">
                <v-btn block @click="authStore.logout">
                    Logout
                </v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script setup lang="ts">
import { useMainStore, useAuthStore } from '@/store'
import { useDisplay } from 'vuetify'
const { name } = useDisplay()
const mainStore = useMainStore()
const authStore = useAuthStore()


</script>