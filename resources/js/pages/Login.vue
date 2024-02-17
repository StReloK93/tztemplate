<template>
    <v-app class="tw-h-screen">
        <v-container class="tw-flex tw-h-full tw-justify-center tw-items-center">
            <v-card class="tw-p-4 py-10" :width="600">
                <v-form @submit.prevent="signin">
                    <v-text-field label="Telefon raqamingizni kiriting" class="mb-4" v-model="phone" type="number"></v-text-field>
                    
                    <VBtn type="submit">
                        Kirish
                    </VBtn>    
                </v-form>
            </v-card>
        </v-container>
    </v-app>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/useAuthStore';
import { ref } from 'vue';
const authStore = useAuthStore()

const phone = ref(null)
async function signin(){
    await authStore.sendSecretCode({phone: phone.value})
}
</script>