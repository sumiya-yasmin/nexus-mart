<script setup>
import { useAuthStore } from "@/store/auth";
import { useCartStore } from "@/store/cart";
import { useProductStore } from "@/store/product";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";
const productStore = useProductStore();
const cartStore = useCartStore();
const authStore = useAuthStore();
const { isLoggedIn } = storeToRefs(authStore);
const router = useRouter();
const toast = useToast();
const handleLogout = async () => {
  await authStore.logout();
   toast.success('Logout Successful', {
      timeout: 2000,
      position: "top-right",
    });
  router.push("/");
};
</script>
<template>
  <div
    class="flex justify-between items-center py-4 px-16 bg-white shadow-sm sticky top-0 z-50"
  >
    <router-link to="/">
      <div class="text-2xl font-black text-blue-600 tracking-tighter">
        NEXUS<span class="text-gray-900">MART</span>
      </div>
    </router-link>
    <div class="hidden md:block flex-1 max-w-md">
      <div class="relative">
        <span
          class="absolute inset-y-0 left-0 pl-3 flex items-center text-lg text-gray-400"
        >
          🔍
        </span>
        <input
          v-model="productStore.searchQuery"
          class="border bg-gray-100 border-gray-200 w-full py-2 pl-10 pr-3 leading-5 rounded-md focus:outline-none focus:bg-white focus:ring-2 transition-all active:scale-95 text-sm"
          placeholder="Search your Gadgets...."
        />
        <button
          v-if="productStore.searchQuery"
          @click="productStore.searchQuery = ''"
          class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
        >
          ✕
        </button>
      </div>
    </div>
    <div class="flex justify-between items-center gap-6">
      <a href="#" class="hover:text-blue-600">Blog</a>
      <router-link to="/cart">
        <button
          class="relative py-2 px-4 text-gray-600 hover:bg-gray-100 rounded-full transition"
        >
          <span class="text-lg">🛒</span>
          <span
            class="absolute right-0 top-0 text-[10px] px-1.5 font-bold rounded-full ring-2 ring-white"
            :class="
              cartStore.totalItems === 0
                ? 'bg-blue-100'
                : 'bg-red-500 text-white'
            "
            >{{ cartStore.totalItems }}</span
          >
        </button>
      </router-link>
      <router-link v-if="!isLoggedIn" to="/login">
        <button
          class="border font-bold rounded-lg bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-100 text-white py-2 px-6"
        >
          Login
        </button>
      </router-link>
      <div
        v-else
        class="flex items-center gap-3 bg-gray-50 p-1.5 pr-4 rounded-full border border-gray-100"
      >
        <div
          class="h-8 w-8 bg-blue-600 text-white flex items-center justify-center rounded-full text-xs font-bold shadow-sm"
        >
          {{ authStore.user?.name?.charAt(0).toUpperCase() }}
        </div>

        <div class="h-4 w-px bg-gray-300 mx-1"></div>

        <button
          @click="handleLogout"
          class="text-xs font-black text-gray-500 hover:text-red-600 uppercase tracking-wider transition-colors"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>
