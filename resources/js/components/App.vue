<template>
    <MyHeader />
    <section class="container mx-auto flex-grow">
        <router-view class="pt-4 h-100"/>
    </section>
</template>

<script setup lang="ts">
import MyHeader from './MyHeader.vue'
import axios from '@/modules/axios'


</script>