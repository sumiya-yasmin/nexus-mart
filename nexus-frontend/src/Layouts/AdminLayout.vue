<script setup>
import SideNav from "@/components/admin/SideNav.vue";
import TopNav from "@/components/admin/TopNav.vue";
</script>

<template>
  <div class="min-h-screen bg-slate-50 flex overflow-hidden shrink-0">
    <SideNav />
    <div class="flex-1 flex flex-col min-w-0">
      <TopNav />
      <main class="flex-1 overflow-y-auto p-8">
        <router-view />
      </main>
    </div>
  </div>
</template>
