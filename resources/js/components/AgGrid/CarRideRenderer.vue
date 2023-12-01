<template>
    <section>
        <v-btn @click="editComponent.toggle(params.data)">
            toggle
        </v-btn>
        <v-btn @click="carDelete">
            delete
        </v-btn>
    </section>
</template>

<script setup lang="ts">
import { useMainStore } from '@/store/useMainStore'
import { inject, Ref } from 'vue'
const editComponent: Ref = inject('editComponent')
const onDelete: Function = inject('onDelete')
const { params } = defineProps(['params'])

const store = useMainStore()


function carDelete() {
    store.dialog.open(() => {
        store.dialog.title = "Qatnovni o'chirmoqchimisiz ?"
        store.dialog.subTitle = "O'chirilgan qatnovlar savatchada 1 oy muddat saqlanadi.",
        store.dialog.submit = () => onDelete(params.data)
    })
}
</script>