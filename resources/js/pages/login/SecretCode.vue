<template>
    <div>
        <p>
            b
            +998 <input type="text" v-maska:[options] v-model="phone" disabled>
        </p>
        <v-otp-input length="5"></v-otp-input>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { vMaska, MaskaDetail } from "maska"
const options = {
	mask: '## ### ## ##',
}
const phone = ref(history.state.props.phone)

</script>