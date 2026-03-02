<script setup>
import { computed, onMounted } from "vue";
import ProductCard from "./ProductCard.vue";
import { useProducts } from "@/composable/useProduct";
const { products, loading, error, loadProducts } = useProducts();
onMounted(() => {
  loadProducts();
});
const props = defineProps(['activeFilter']);
const emit = defineEmits(['clear-filter'])
const filteredProducts = computed(() => {
  if (!props.activeFilter) {
    return products.value;
  }
  return products.value.filter((product) => product.category.slug === props.activeFilter);
})
</script>
<template>
  <div class="max-w-7xl mx-auto px-4 pb-12 mt-12">
    <h2 class="text-xl font-bold mb-10 text-center">Featured Products</h2>
<div v-if="!loading && filteredProducts.length === 0" class="text-center py-20 bg-gray-50 rounded-2xl">
      <p class="text-gray-500 text-lg">No products found in the <span class="font-bold">"{{ activeFilter }}"</span> category.</p>
      <button @click="$emit('clear-filter')" class="mt-4 text-blue-500 underline">Show all products</button>
    </div>
        <div v-if="loading" class="text-center py-10">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <ProductCard
        v-for="product in filteredProducts"
        :key="product.id"
        :product="product"
      />
    </div>
  </div>
</template>
