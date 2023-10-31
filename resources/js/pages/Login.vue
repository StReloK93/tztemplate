<template>
    <div name="login" class="flex justify-center items-center h-full">
        <form class="bg-white shadow px-4 py-6 border-t-2 border-cyan-400 w-80 rounded">
            <div class="mb-4">
                <label for="email-input" class="input-label">Email</label>
                <input id="email-input" type="email" class="input">
            </div>
            <div class="mb-4">
                <label for="password-input" class="input-label">Password</label>
                <input id="password-input" type="password" class="input">
            </div>
            <div class="flex justify-between items-center mb-4">
                <button type="submit" class="btn btn-gray">
                    Login
                </button>

                <router-link :to="{name: 'forgotpassword'}" class="text-sm text-sky-400">Forgot password?</router-link>
            </div>
            <div class="text-sm text-center text-gray-500">
                Don't have an account? <router-link :to="{name: 'register'}" class="text-sky-400">Create an Account</router-link>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">

</script>