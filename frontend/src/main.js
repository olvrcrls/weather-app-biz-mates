import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';


import './assets/main.css';
import router from './router';

window.axios = axios;
window.localUrl = 'http://localhost:8000/api';

const app = createApp(App);
app.use(router);
app.mount('#app');
