import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Tambahkan import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css'
// Opsional: Jika butuh JavaScript Bootstrap:
// import 'bootstrap/dist/js/bootstrap.bundle.min.js'

createApp(App).use(router).mount('#app')
