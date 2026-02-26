<script setup>
import Footer from "@/components/Footer.vue";
import Navbar from "../components/Navbar.vue";
</script>

<template>
  <div class="min-h-screen bg-slate-50 flex flex-col">
    <Navbar />

    <main class="flex-grow">
      <slot />
    </main>
    <Footer />
  </div>
</template>