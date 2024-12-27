//import createApp from Vue
import { createApp } from 'vue';
//import component App
import App from './App.vue';
//import config router
import router from './router'
//create App Vue
const app = createApp(App);
//gunakan "router" di Vue dengan plugin "use"
app.use(router);
app.mount('#app');