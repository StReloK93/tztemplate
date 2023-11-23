import { createApp } from 'vue'
import { useAuthStore } from './store/useAuthStore'
import { createPinia } from 'pinia'
import App from './components/App.vue'
import CustomForm from './components/Form.vue'
// import CreateForm from './components/CreateForm.vue'
import router from './routes'
import vuetify from './modules/vuetify'
import { AgGridVue } from "ag-grid-vue3"
import "ag-grid-community/styles/ag-grid.css"
import "ag-grid-community/styles/ag-theme-alpine.css"
import '../css/app.css'


const pinia = createPinia()
const app = createApp(App)
app
	.component('AgGridVue', AgGridVue)
	.component('CustomForm', CustomForm)
	// .component('CreateForm', CreateForm)
	.use(vuetify)
	.use(pinia)
const store = useAuthStore()

async function init() {
	await store.getUser()
	app.use(router)
	app.mount("#app")
}
init()
