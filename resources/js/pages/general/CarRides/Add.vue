<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" class="add-button" />
        </template>
        <CustomForm :submit="submitFunction" title="Qatnov kiritish" @close="pageData.dialog = false">
            <Inputs ref="inputComponent" :date="props.date" />
        </CustomForm>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import Inputs from './Inputs.vue'
import moneyConfig from '@/modules/moneyConfig'
import { unformat } from 'v-money3'
const props = defineProps(['date'])
const emit = defineEmits(['create'])
const inputComponent = ref()
const pageData = reactive({ dialog: false })


async function submitFunction() {
    const formData = inputComponent.value.formData
    
    formData.price = unformat(formData.price, moneyConfig)
    if (formData.strictly_on_time == null) formData.strictly_on_time = false
    if (formData.address_to_address == null) formData.address_to_address = false
    await axios.post('car-ride', formData).then(({ data }) => {
        emit('create', data)
    })
}
</script>