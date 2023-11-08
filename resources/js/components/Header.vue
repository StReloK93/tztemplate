<template>
    <Navigator/>
    <v-app-bar :elevation="0" :border="1" color="transparent">
        <!-- <template v-slot:prepend>
            <v-app-bar-nav-icon @click="mainStore.menu = !mainStore.menu"></v-app-bar-nav-icon>
        </template> -->
        <v-app-bar-title>Title</v-app-bar-title>
        <v-spacer></v-spacer>
        <v-btn icon="mdi-magnify"/>
    </v-app-bar>
</template>

<script setup lang="ts">
import Navigator from './Navigator.vue'
import { useMainStore } from '@/store/useMainStore'

const mainStore = useMainStore()
</script>