<template>
   <v-dialog v-model="props.dialog" scrollable persistent width="800px">
      <v-card @vue:unmounted="ride = null">
         <v-card-title>{{ ride?.car.type }} - {{ ride?.car.number }}</v-card-title>
         <v-card-text class="px-4 py-3 d-flex flex-column" style="height: 300px">
            <main class="d-flex justify-space-between tw-relative">
               <div class="tw-border-b tw-absolute tw-w-full tw-z-0 tw-bottom-[9px] tw-border-dashed tw-border-gray-400"></div>
               <div v-for="(city, index) in ride?.cities" :class="[ride?.cities.length == index + 1 ? 'tw-text-right' : '']" class="bg-white tw-relative px-2 -tw-mx-2">
                  <header :class="[index != 0 && ride?.cities.length - 1 != index ? 'text-center' : '']" class="tw-text-xs tw-text-gray-400">
                     {{ city.district.region.name }}
                  </header>
                  <footer class="tw-text-base">
                     {{ city.district.name }}
                  </footer>
               </div>
            </main>
            <aside class="text-right my-2 tw-text-xl tw-text-pink-600 tw-font-semibold">
               {{ ride?.price }} so'm
            </aside>
            <v-spacer>
               <table class="w-100 tw-border-collapse tw-border tw-text-sm">
                  <tr>
                     <td class="tw-border-y tw-px-1 tw-py-0.5 tw-bg-gray-100">
                        F.I.SH
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5 tw-bg-gray-100">
                        Telefon
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5 tw-bg-gray-100">
                        Manzil
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5 tw-bg-gray-100">
                        Boriladigan manzil
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5 tw-bg-gray-100">
                        Kiritildi
                     </td>
                  </tr>
                  <tr v-for="passenger in ride?.passengers">
                     <td class="tw-border-y tw-px-1 tw-py-0.5">
                        {{ passenger.name }}
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5">
                        {{ passenger.phone }}
                        <input type="text" class="tw-w-[144px]" v-maska:[options] v-model="passenger.phone" disabled hidden>
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5">
                        {{ passenger.address }}
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5">
                        {{ passenger.end.region.name.replace('shahri', '').replace("viloyati", "") }}-
                        {{ passenger.end.name }}
                     </td>
                     <td class="tw-border-y tw-px-1 tw-py-0.5">
                        23-10-2024 16:34
                     </td>
                  </tr>
               </table>
            </v-spacer>
         </v-card-text>
         <v-divider class="border-opacity-50"></v-divider>
         <v-card-actions>
            <v-btn v-if="ride?.phone" tag="a" prepend-icon="mdi-phone" :href="`tel:${ride?.phone}`" class="tw-inline-flex tw-items-center">
               <input type="text" class="tw-w-[144px]" v-maska:[options] v-model="ride.phone" disabled hidden> {{ ride.phone }}
            </v-btn>
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
</template>

<script setup lang="ts">
import { reactive, ref, Ref } from 'vue'
import { vMaska } from "maska"
import { CarRide } from '@/interfaces'
const props = reactive({
   dialog: false,
})
const options = { mask: '+### ## ###-##-##' }

const ride: Ref<CarRide> = ref(null)
function getCarRide(ride_id) {
   axios.get<CarRide>(`car-ride/${ride_id}`).then(async ({ data }) => ride.value = data)
}

const openModal = (ride_id) => {
   props.dialog = true
   getCarRide(ride_id)

}
defineExpose({ openModal })
</script>
