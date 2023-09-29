import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../components/Home.vue';
import Profile from '../components/Profile.vue';

Vue.use(VueRouter);

const routes = [
  { path: '/', component: Home },
  { path: '/profile', component: Profile }
];

const router = new VueRouter({
  routes
});

export default router;