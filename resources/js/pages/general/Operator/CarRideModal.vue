<template>
   <div class="pa-4 text-center">
      <v-dialog v-model="props.dialog" scrollable persistent width="600px">
         <v-card  @vue:unmounted="ride = null">
            <v-card-title >{{ride?.car.type}} - {{ ride?.car.number }}</v-card-title>
            <v-divider class="mt-3"></v-divider>
            <v-card-text class="px-4" style="height: 300px;">
               {{ride?.phone}}
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
import { reactive, ref, Ref } from 'vue'
import { CarRide } from '@/interfaces'
const props = reactive({
   dialog: false,
})

const ride: Ref<CarRide> = ref()
function getCarRide(ride_id) {
   axios.get<CarRide>(`car-ride/${ride_id}`).then(async ({ data }) => {

      ride.value = data

   })
}


const openModal = (ride_id) => {
   props.dialog = true
   getCarRide(ride_id)

}
defineExpose({ openModal })
</script>
