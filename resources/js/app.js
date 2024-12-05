// Importer Vue et le composant principal
import { createApp } from 'vue';
import App from './components/App.vue';
import axios from 'axios';

// Créer l'instance de Vue et monter l'application
const app = createApp(App);

// Ajouter Axios globalement
app.config.globalProperties.$axios = axios;

// Monter l'application Vue sur l'élément avec l'ID "app"
app.mount('#app');

