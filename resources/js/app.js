import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router/index.js';
import Bienvenue from './components/GraphData.vue';
import HighchartsVue from 'highcharts-vue';

const app = createApp(App);

app.use(router);
app.use(HighchartsVue);

app.config.globalProperties.$axios = axios;
app.component('Bienvenue', Bienvenue);

app.mount('#app');
