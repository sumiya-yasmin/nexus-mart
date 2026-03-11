import AdminLayout from "@/Layouts/AdminLayout.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import Dashboard from "@/pages/admin/Dashboard.vue";
import Order from "@/pages/admin/Order.vue";
import OrderDetail from "@/pages/admin/OrderDetail.vue";
import CartView from "@/pages/CartView.vue";
import Home from "@/pages/Home.vue";
import Login from "@/pages/Login.vue";
import MyOrders from "@/pages/MyOrders.vue";
import ProductDetail from "@/pages/ProductDetail.vue";
import Register from "@/pages/Register.vue";
import { useAuthStore } from "@/store/auth";
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    component: MainLayout,
    children: [
      { path: "", component: Home },
      { path: "/product/:slug", component: ProductDetail, props: true },
      { path: "/cart", component: CartView, meta: { requiresAuth: true } },
      { path: "/register", component: Register },
      { path: "/login", component: Login, meta: { guestOnly: true } },
      {
        path: "/profile",
        meta: { requiresAuth: true },
        children: [
          {
            path: "orders",
            name: "my-orders",
            component: MyOrders,
          },
        ],
      },
    ],
  },
  {
    path: "/admin",
    component: AdminLayout,
    meta: { requiresAuth: true, requiresAdmin: true },
    children: [
      { path: "dashboard", name: "admin-dashboard", component: Dashboard },
      { path: "orders", name: "admin-orders", component: Order },
      {path: "/orders/:id", name:"admin-order-detail", component: OrderDetail}
      
    ]
  }
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  if (to.meta.requiresAdmin && !authStore.isAdmin) {
    return next({ path: '/' });
  }

  if (to.meta.requiresAuth && !authStore.isLoggedIn) {
    next({ path: "/login", query: { redirect: to.fullPath } });
  } else if (to.meta.guestOnly && authStore.isLoggedIn) {
    next("/");
  } else {
    next();
  }
});
export default router;
