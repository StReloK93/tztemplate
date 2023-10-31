<template>
    <header class="bg-white shadow">
        <section class="flex justify-between items-center container mx-auto py-5 ">
            <RouterLink :to="{name: 'main'}"  class="text-xl">
                <span >Tz</span>
                <span class="text-sky-400 font-semibold"> Template</span>
            </RouterLink>
            <main v-if="authStore.user == null">
                <router-link :to="{name: 'login'}" class="btn btn-gray auth">Login</router-link>
                <router-link :to="{name: 'register'}" class="btn btn-gray ml-4 auth">Register</router-link>
            </main>
            <main v-else >
                <button @click="authStore.logout()" class="btn btn-gray">Logout</button>
            </main>
        </section>
    </header>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/useAuthStore';

const authStore = useAuthStore()
</script>