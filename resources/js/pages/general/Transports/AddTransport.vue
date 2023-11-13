<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" />
        </template>
        <CustomForm :submit="submitFunction" title="Mahsulot kiritish" @close="pageData.dialog = false">
            <TransportInputs ref="inputComponent" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import axios from '@/modules/axios'
import CustomForm from '@/components/Form.vue'
import TransportInputs from './InputsTransport.vue'
const emit = defineEmits(['create'])
const inputComponent = ref()
const pageData = reactive({dialog: false})

async function submitFunction() {
    const formData = inputComponent.value.formData

    await axios.post('car', formData).then(({data}) => {
        emit('create', data)
    })
}
</script>