import {createRouter, createWebHistory} from 'vue-router';
import HomeView from '../views/HomeView.vue';
import NearbyPlaces from '../views/NearbyPlaces.vue';



const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
      {
        path: '/',
        name: 'home',
        component: HomeView,
      },
      {
        path: '/nearby-places',
        name: 'nearby_places',
        component: NearbyPlaces
      }
    ]
  });
  
export default router;
