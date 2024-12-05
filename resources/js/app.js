// // Importer Vue et le composant principal
// import { createApp } from 'vue';
// import App from './components/App.vue';
// import axios from 'axios';

// // Créer l'instance de Vue et monter l'application
// const app = createApp(App);

// // Ajouter Axios globalement
// app.config.globalProperties.$axios = axios;

// // Monter l'application Vue sur l'élément avec l'ID "app"
// app.mount('#app');

import { createApp } from 'vue'; // Vue 3.x
import HelloWorld from './components/HelloWorld.vue'; // Importer le composant Vue

const app = createApp({}); // Créer une instance de l'application Vue
app.component('hello-world', HelloWorld); // Enregistrer le composant globalement
app.mount('#app'); // Monter l'application Vue sur l'élément avec l'ID "app"