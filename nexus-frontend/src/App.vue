<script setup>
import CategoryRow from "./components/CategoryRow.vue";
import FeaturedProducts from "./components/FeaturedProducts.vue";
import HeroSlider from "./components/HeroSlider.vue";
import Navbar from "./components/Navbar.vue";
</script>

<template>
  <div class="min-h-screen bg-slate-50">
  <Navbar />
  <HeroSlider />
  <CategoryRow />
  <FeaturedProducts />
  </div>
</template>

<style scoped></style>
