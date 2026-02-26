<script setup>
import CategoryRow from "./components/CategoryRow.vue";
import FeaturedProducts from "./components/FeaturedProducts.vue";
import HeroSlider from "./components/HeroSlider.vue";
import Navbar from "./components/Navbar.vue";
import MainLayout from "./Layouts/MainLayout.vue";
</script>

<template>
  <MainLayout> 

  <HeroSlider />
  <CategoryRow />
  <FeaturedProducts />
  </MainLayout>
</template>

<style scoped></style>
