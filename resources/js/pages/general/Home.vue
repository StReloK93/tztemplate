<template>
    <v-app>
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
</script>