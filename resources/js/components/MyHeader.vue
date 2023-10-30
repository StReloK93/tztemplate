<template>
    <header class="bg-white shadow">
        <section class="flex justify-between items-center container mx-auto py-5 ">
            <RouterLink :to="{name: 'main'}"  class="text-xl">
                <span >Tz</span>
                <span class="text-sky-500 font-semibold"> Template</span>
            </RouterLink>
            <main>
                <router-link :to="{name: 'login'}" class="btn bg-gray-100 hover:bg-sky-500 hover:text-white auth">Login</router-link>
                <router-link :to="{name: 'register'}" class="btn bg-gray-100 hover:bg-sky-500 hover:text-white ml-4 auth">Register</router-link>
            </main>
        </section>
    </header>
</template>

<script setup lang="ts">

</script>