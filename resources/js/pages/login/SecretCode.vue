<template>
   <v-form @submit.prevent="submit" class="text-center d-flex flex-column tw-items-center">
      <h3 class="text-h5 font-weight-bold">Telefon raqamni tasdiqlash</h3>
      <p class="my-2 d-flex tw-items-center tw-justify-start">
         <span class="tw-text-sm font-weight-bold text-grey-darken-3">
            +998 <input type="text" class="tw-w-[90px]" v-maska:[options] v-model="phone" disabled>
         </span>
      </p>
      <p class="text-grey-darken-1 w-75 ">
         Kiritgan raqamingizga tasdiqlovchi maxfiy kod junatildi.
      </p>
      <v-otp-input v-model="secredCode" length="5"></v-otp-input>

      <v-btn type="submit" :loading="loading" append-icon="mdi-login" class="w-75">
         Tasdiqlash
      </v-btn>
   </v-form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { vMaska } from "maska"
const options = { mask: '## ###-##-##' }
const phone = ref(history.state.props.phone)

const secredCode = ref('')
const loading = ref(false)

function submit() {
   loading.value = true
   console.log(secredCode.value)
   
}



</script>