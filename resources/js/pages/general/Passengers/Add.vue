<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" class="add-button" />
        </template>
        <CustomForm :submit="submitFunction" title="Yo'lovchi kiritish" @close="pageData.dialog = false">
            <Inputs ref="inputComponent" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import Inputs from './Inputs.vue'
import { Passenger } from '@/interfaces';
const emit = defineEmits(['create'])
const inputComponent = ref()
const pageData = reactive({dialog: false})

async function submitFunction() {
    const formData: Passenger = inputComponent.value.formData

    await axios.post<Passenger>('passenger', formData).then(({data}) => {
        emit('create', data)
    })
}
</script>