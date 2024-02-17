import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'
import { createPinia } from 'pinia'
import App from './components/App.vue'
import CustomForm from './components/Form.vue'
import router from './routes'
import vuetify from './modules/vuetify'
import Echo from './modules/echo'
import axios from '@/modules/axios'
import { AgGridVue } from "ag-grid-vue3"
import VCalendar from 'v-calendar'
import money from 'v-money3'

import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-alpine.css"
import '../css/app.css'
import 'v-calendar/style.css';
// @ts-ignore
window.axios = axios
// @ts-ignore
window.echo = Echo



async function init() {
	const pinia = createPinia()
	const app = createApp(App)
	app
		.component('AgGridVue', AgGridVue)
		.component('CustomForm', CustomForm)
		.use(vuetify)
		.use(pinia)
		.use(VCalendar, {})
		.use(money)
	const store = useAuthStore()
	await store.getUser()
	app.use(router)
	app.mount("#app")
	axios.defaults.headers.common['X-Socket-Id'] = echo.socketId();
}
init()