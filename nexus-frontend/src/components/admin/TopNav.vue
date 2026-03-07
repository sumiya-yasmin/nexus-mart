<script setup>
import { useAuthStore } from "@/store/auth";
import { useRoute, useRouter } from "vue-router";
import { useToast } from "vue-toastification";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const toast = useToast();
const handleLogout = async () => {
  await authStore.logout();
  toast.success("Logout Successful", {
    timeout: 1000,
    position: "top-right",
  });
  router.push("/login");
};
</script>
<template>
  <div
    class="flex justify-between items-center py-4 px-16 bg-white shadow-sm sticky top-0 z-50"
  >
  <div class="flex items-center">
      <h1 class="text-lg font-semibold text-gray-800 capitalize">
{{ route.name?.replace('admin-', '') || 'Overview' }}      </h1>
    </div>
   
    <div class="flex">
      <div class="text-right flex flex-col justify-center">
        <p class="text-xs font-bold text-gray-900">
          {{ authStore.user?.name }}
        </p>
        <p class="text-[10px] text-gray-500 uppercase tracking-widest">
          Administrator
        </p>
      </div>
      <div
        class="flex items-center gap-3 bg-gray-50 p-1.5 pr-4 ml-1 rounded-full border border-gray-100"
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
