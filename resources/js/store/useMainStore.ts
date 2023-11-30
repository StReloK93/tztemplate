import { defineStore } from "pinia"
import { ref, Ref, reactive } from "vue"
import { Dialog } from "@/interfaces"


export const useMainStore = defineStore('Main', () => {
    const menu: Ref<boolean> = ref(false)

    const dialog: Dialog = reactive({
        model: false,
        title: null,
        subTitle: null,
        icon: 'mdi-bell-outline',
        reset: () => {
            setTimeout(() => {
                dialog.model = false
                dialog.title = null
                dialog.subTitle = null
                dialog.icon = 'mdi-bell-outline'
                dialog.submit = null
            }, 200)
        },
        open: (callBack: Function = null) => {
            dialog.model = true
            if (callBack) callBack()
        },
        submitInner: () => {
            if (dialog.submit) dialog.submit()
            else return console.error('Submit function not found!')
            dialog.model = false
        },
        submit: null,
        cancel: (callBack: Function = null) => {
            if (callBack) callBack()
            dialog.model = false
        },
    })

    return { menu, dialog }
})