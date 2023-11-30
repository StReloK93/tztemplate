<template>
    <v-app class="bg-grey-lighten-5">
        <Alert />
        <Header />
        <v-main>
            <v-container class="h-100">
                <router-view class="h-100 tw-relative"></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup lang="ts">
import Header from '@/components/Header.vue'
import Alert from '@/components/Alert.vue'
</script>