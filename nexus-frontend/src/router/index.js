import CartView from "@/pages/CartView.vue";
import Home from "@/pages/Home.vue";
import Login from "@/pages/Login.vue";
import ProductDetail from "@/pages/ProductDetail.vue";
import Register from "@/pages/Register.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  { path: "/", component: Home },
  { path: "/product/:slug", component: ProductDetail, props: true },
  { path: "/cart", component: CartView },
  { path: "/register", component: Register },
    {path: "/login", component: Login},

];
const router = createRouter({
  history: createWebHistory(),
  routes,
});
export default router;
