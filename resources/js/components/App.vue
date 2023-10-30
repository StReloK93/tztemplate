<template>
    <MyHeader />
    <section class="container mx-auto">
        <router-view class="pt-4"/>
    </section>
</template>

<script setup lang="ts">
import MyHeader from './MyHeader.vue';
</script>