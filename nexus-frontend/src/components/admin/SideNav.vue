<script setup>
const navlinks = [
    { name: 'Dashboard', path: '/admin/dashboard' },
    { name: 'Orders', path: '/admin/orders' },
    {name: 'Users', path: '/admin/users'}
]
</script>

<template>
  <div class="h-screen w-64 bg-slate-900 flex flex-col">
    <div class="text-3xl font-black text-blue-600 tracking-tighter p-4">
      NEXUS<span class="text-white">ADMIN</span>
    </div>
    <div class="p-4">
        <router-link v-for="link in navlinks" :key="link.path"
        :to="link.path"
        class="flex items-center gap-3 px-4 py-3 text-slate-300 rounded-lg transition-all duration-200 hover:bg-slate-800 hover:text-white group"
          active-class="bg-blue-600 !text-white shadow-lg shadow-blue-900/20"
        >
           <span class="font-medium">{{ link.name }}</span> 
        </router-link>
    </div>
    <div class="p-4 border-t border-slate-800 mt-auto">
        <router-link to="/" class="flex items-center gap-2 text-sm text-slate-400 hover:text-white p-2">
            <span>←</span> Back to Shop
        </router-link>
    </div>
  </div>
</template>
