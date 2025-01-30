import { createRouter, createWebHistory } from 'vue-router';
import Bienvenue from '../components/GraphData.vue';

const routes = [
  {
    path: '/',
    name: 'Accueil',
    component: Bienvenue,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
