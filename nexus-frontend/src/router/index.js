import CartView from "@/pages/CartView.vue";
import Home from "@/pages/Home.vue";
import ProductDetail from "@/pages/ProductDetail.vue";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  { path: "/", component: Home },
  { path: "/product/:slug", component: ProductDetail, props: true },
  { path: "/cart", component: CartView },
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});
export default router;
