<template>
   <v-sheet tag="button" elevation="1" color="pink"
      class="d-flex w-100 justify-space-between tw-flex-wrap px-3 tw-py-0.5 rounded mb-1 tw-cursor-pointer" v-ripple>
      <aside class="w-50 tw-text-left">
         {{ props.ride.car.type }}
      </aside>
      <div class="w-50 tw-text-right tw-font-bold text-pink-lighten-5">
         {{ props.ride.price }} so'm
      </div>
      <main class="w-full">
         <span v-for="(n,index) in props.ride.free_seat">
            <v-icon v-if="index < props.ride.passengers.length"  size="small">mdi-account</v-icon>
            <v-icon v-else size="small" color="pink-lighten-2">mdi-account</v-icon>
         </span>
      </main>
   </v-sheet>
</template>

<script setup lang="ts">
const props = defineProps(['ride'])
</script>