<template>
    <v-app class="bg-grey-lighten-5">
        <Header />
        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import Header from '@/components/Header.vue'
import { useRoute } from 'vue-router'

console.log(useRoute())

</script>