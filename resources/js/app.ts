import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'
import { createPinia } from 'pinia'
import App from './components/App.vue'
import router from './routes'

import '../css/app.css'
import vuetify from './modules/vuetify'


import { AgGridVue } from "ag-grid-vue3"
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-alpine.css"

const pinia = createPinia()
const app = createApp(App)
app
.component('AgGridVue',AgGridVue)
.use(vuetify)
.use(pinia)
const store = useAuthStore()

async function init() {
	await store.getUser()
	app.use(router)
	app.mount("#app")
}
init()
