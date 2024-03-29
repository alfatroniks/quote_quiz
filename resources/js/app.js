// import './bootstrap';
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App';
import '../css/app.css'
import router from './router'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/';

const pinia = createPinia()

const app = createApp(App)

app.use(pinia)
app.use(router)
app.mount('#app')
