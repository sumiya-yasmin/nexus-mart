<script setup>
import { onMounted } from "vue";
import ProductCard from "./ProductCard.vue";
import { useProducts } from "@/composable/useProduct";
const { products, loading, error, loadProducts } = useProducts();
onMounted(() => {
  loadProducts();
});
</script>
<template>
  <div class="max-w-7xl mx-auto px-4 pb-12 mt-12">
    <h2 class="text-xl font-bold mb-10 text-center">Featured Products</h2>
    <div v-if="loading" class="text-center py-10">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
    </div>
  </div>
</template>
