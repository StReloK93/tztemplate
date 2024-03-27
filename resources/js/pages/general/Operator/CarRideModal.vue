<template>
   <div class="pa-4 text-center">
      <v-dialog v-model="props.dialog" scrollable persistent width="600px">
         <v-card>
            <v-divider class="mt-3"></v-divider>

            <v-card-text class="px-4" style="height: 300px;">
               asdsa
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
               <v-spacer></v-spacer>
               <v-btn color="primary" variant="text" @click="props.dialog = false">
                  Yopish
               </v-btn>
               <v-btn color="primary" type="submit" class="ml-4" variant="tonal">
                  Saqlash
               </v-btn>
            </v-card-actions>
         </v-card>
      </v-dialog>
   </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
const props = reactive({
   dialog: false,
   ride: null
})

function getCarRide(ride_id) {
   
}


const toggle = (ride_id) => {
   props.dialog = true
   props.ride = ride_id
}
defineExpose({ toggle })
</script>
