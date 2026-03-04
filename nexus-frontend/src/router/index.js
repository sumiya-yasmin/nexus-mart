import CartView from "@/pages/CartView.vue";
import Home from "@/pages/Home.vue";
import Login from "@/pages/Login.vue";
import ProductDetail from "@/pages/ProductDetail.vue";
import Register from "@/pages/Register.vue";
import { useAuthStore } from "@/store/auth";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  { path: "/", component: Home },
  { path: "/product/:slug", component: ProductDetail, props: true },
  { path: "/cart", component: CartView, meta: { requiresAuth: true } },
  { path: "/register", component: Register },
  {path: "/login", component: Login, meta: { guestOnly: true }},

];
const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  if (to.meta.requiresAuth && !authStore.isLoggedIn) {
    next({ path: '/login', query: { redirect: to.fullPath } });
  } else if (to.meta.guestOnly && authStore.isLoggedIn) {
    next('/');
  } else {
    next();
  }


})
export default router;
