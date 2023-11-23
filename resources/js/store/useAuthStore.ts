
import { defineStore } from "pinia"
import { ref } from "vue"
import router from "@/routes"
import axios from '@/modules/axios'
import axioss from 'axios'

export const useAuthStore = defineStore('Auth', () => {
    const user = ref(null)

    async function login(data) {

        axioss.get('sanctum/csrf-cookie').then(async response => {
            const result = await axios.post('login', data)
            if (result.status == 299) return result.data
            else {
                localStorage.setItem('token', `${result.data.type} ${result.data.token}`) // local
                await getUser()
                router.push({ name: 'main'})
            }
        })

    }


    async function getUser() {

        axios.defaults.headers.common['Authorization'] = localStorage.getItem('token')
        await axios.get('user').then(({ data }) => {
            user.value = data
        }).catch(() => {
            console.clear()
        })

    }


    async function register(props) {
        try{
            const result = await axios.post('register', props)
            if (result.status == 200) login(props)
            else return result.data
        } catch (err){
            return err.response.data
        }
    }

    async function logout() {
        const data = await axios.get('logout')

        if (data.status == 200) {
            axios.defaults.headers.common['Authorization'] = null
            localStorage.removeItem('token')
            user.value = null
            router.push({ name: 'login' })
        }
    }

    return { user, getUser, login, register, logout }
})