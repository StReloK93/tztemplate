<template>
    <div name="login" class="flex justify-center items-center h-full">
        <form @submit.prevent="register" class="bg-white shadow px-4 py-6 border-t-2 border-cyan-400 w-80 rounded">
            <div class="mb-4">
                <label for="name-input" class="input-label">Name</label>
                <input id="name-input" v-model="formData.name" type="text" class="input">
            </div>
            <div class="mb-4">
                <label for="email-input" class="input-label">Email</label>
                <input id="email-input" v-model="formData.email" type="email" class="input">
            </div>
            <div class="mb-4">
                <label for="password-input" class="input-label">Password</label>
                <input id="password-input" v-model="formData.password" type="password" class="input">
            </div>
            <div class="mb-4">
                <label for="confirm-password-input" class="input-label">Confirm Password</label>
                <input id="confirm-password-input" v-model="formData.password_confirmation" type="password" class="input">
            </div>
            <div class="flex justify-between items-center mb-4">
                <button type="submit" class="btn btn-gray w-full">
                    Register
                </button>
            </div>
            <div class="text-sm text-center text-gray-500">
                Have an account? <router-link :to="{name: 'login'}" class="text-sky-400">Sign in</router-link>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/useAuthStore';
import { reactive } from 'vue'
const authStore = useAuthStore()


const formData = reactive({
    name: 'Aziz Soliyev',
    email: 'strelok0493@gmail.com',
    password: 'strelok',
    password_confirmation: 'strelok',
})

const componentData = reactive({
    errorRegister: null,
})

function register(){
    authStore.register(formData).then(({data}) => {
        componentData.errorRegister = data
        setTimeout(() => componentData.errorRegister = null, 5000)
    })

}

</script>