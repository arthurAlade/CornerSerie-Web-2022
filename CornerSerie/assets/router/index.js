import { createRouter, createWebHashHistory } from 'vue-router'
import Emprunts from './../components/App.vue'
const routes = [
    // À compléter
    {
      path: '/router',
      name : 'homepage-home',
      component: Emprunts
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
  })

export default router