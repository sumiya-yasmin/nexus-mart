<script setup>
import { ref } from 'vue';
const searchInput = ref('');
const cartCount = ref(0);
</script>
<template>
  <div
    class="flex justify-between items-center py-4 px-16 bg-white shadow-sm sticky top-0 z-50"
  >
    <div class="text-2xl font-black text-blue-600 tracking-tighter">
      NEXUS<span class="text-gray-900">MART</span>
    </div>
    <div class="hidden md:block flex-1 max-w-md">
      <div class="relative">
        <span
          class="absolute inset-y-0 left-0 pl-3 flex items-center text-lg text-gray-400"
        >
          🔍
        </span>
        <input
         v-model="searchInput"
          class="border bg-gray-100 border-gray-200 w-full py-2 pl-10 pr-3 leading-5 rounded-md focus:outline-none focus:bg-white focus:ring-2"
          placeholder="Search your Gadgets...."
        />
      </div>
    </div>
    <div class="flex justify-between items-center gap-6">
      <a href="#" class="hover:text-blue-600">Blog</a>
      <button
        class="relative py-2 px-4 text-gray-600 hover:bg-gray-100 rounded-full transition"
      >
        <span class="text-lg">🛒</span>
        <span
          class="absolute right-0 top-0 text-[10px] px-1.5 font-bold rounded-full ring-2 ring-white"
          :class="cartCount===0? 'bg-blue-100':'bg-red-500'"
          >{{cartCount}}</span
        >
      </button>
      <button
        class="border rounded-md hover:bg-blue-600 hover:text-white py-2 px-4"
      >
        Login
      </button>
    </div>
  </div>
</template>
