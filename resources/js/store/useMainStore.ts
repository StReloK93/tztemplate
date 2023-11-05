import { defineStore } from "pinia"
import { ref } from "vue"
import router from "@/routes"

export const useMainStore = defineStore('Main', () => {
    const menu = ref(true)
    return { menu}
})