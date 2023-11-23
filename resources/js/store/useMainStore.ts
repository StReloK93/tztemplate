import { defineStore } from "pinia"
import { ref } from "vue"

export const useMainStore = defineStore('Main', () => {
    const menu = ref(false)
    return { menu }
})