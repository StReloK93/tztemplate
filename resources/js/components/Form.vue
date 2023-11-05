<template>
    <v-dialog v-model="pageData.dialog" scrollable persistent width="600px">
        <template v-slot:activator="{ props }">
            <v-btn color="primary" v-bind="props" icon="mdi-plus" />
        </template>
        <v-form ref="formTag" @submit.prevent="submitFunction" @vue:mounted="" @vue:unmounted="pageData.loading = false">
            <v-card>
                <v-card-title>Select Country</v-card-title>
                <v-divider></v-divider>
                <v-card-text style="height: 300px;" class="pa-0">
                    <v-container>
                        <slot></slot>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" variant="text" @click="pageData.dialog = false">
                        Yopish
                    </v-btn>
                    <v-btn color="primary" type="submit" class="ml-4" variant="flat" :loading="pageData.loading">
                        Saqlash
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>

<script setup lang="ts">
import { reactive , ref} from 'vue'
const { submit } = defineProps({
    submit: { type: Function, required: true }
})
const formTag = ref()

const pageData = reactive({
    dialog: false,
    loading: false,
})


function submitFunction() {
    const { valid } = formTag.value.validate()
    if(valid == false || pageData.loading) return
    pageData.loading = true

    submit()
}
</script>