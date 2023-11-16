import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'
import { createPinia } from 'pinia'
import App from './components/App.vue'
import router from './routes'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import vuetify from './modules/vuetify'


import { AgGridVue } from "ag-grid-vue3"
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-alpine.css"
import '../css/app.css'




// @ts-ignore
window.Pusher = Pusher

const acho = new Echo({
	broadcaster: 'pusher',
	wsHost: '127.0.0.1',
	wsPort: 6001,
	// @ts-ignore
	key: import.meta.env.VITE_PUSHER_APP_KEY,
	// @ts-ignore
	cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
	disableStats: true,
	forceTLS: true,
});

acho.channel('home').listen('NewEvent', (e) => {
	console.log(e.msg);
})

const pinia = createPinia()
const app = createApp(App)
app.component('AgGridVue', AgGridVue)
	.use(vuetify)
	.use(pinia)
const store = useAuthStore()

async function init() {
	await store.getUser()
	app.use(router)
	app.mount("#app")
}
init()
