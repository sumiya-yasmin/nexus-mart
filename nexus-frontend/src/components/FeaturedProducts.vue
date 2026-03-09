<script setup>
import { computed, onMounted } from "vue";
import ProductCard from "./ProductCard.vue";
import { useProducts } from "@/composable/useProduct";
import { useProductStore } from "@/store/product";
const { products, loading, error, loadProducts } = useProducts();
onMounted(() => {
  loadProducts();
});
const productStore = useProductStore();
const props = defineProps(['activeFilter']);
const emit = defineEmits(['clear-filter'])
const filteredProducts = computed(() => {
  if (!products.value) return [];
  let list = products.value;
  if (!props.activeFilter && !productStore.searchQuery) {
    return products.value;
  }
  if (props.activeFilter) {
    list = list.filter((product) => product.category.slug === props.activeFilter);
  }
  if (productStore.searchQuery) {
    const query = productStore.searchQuery.toLowerCase();
    list = list.filter((p)=> p?.name?.toLowerCase().includes(query) || p?.category?.name?.toLowerCase().includes(query))
  }
  return list;
})
</script>
<template>
  <div class="max-w-7xl mx-auto px-4 pb-12 mt-12">
    <div v-if="activeFilter || productStore.searchQuery" class="flex justify-end mb-4">
      <button 
        @click="$emit('clear-filter')" 
        class="text-sm bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition"
      >
        ✕ Clear All Filters
      </button>
    </div>
    <h2 class="text-xl font-bold mb-10 text-center">Featured Products</h2>
<div v-if="!loading && filteredProducts.length === 0" class="text-center py-20 bg-gray-50 rounded-2xl">
      <p class="text-gray-500 text-lg">No products found in the <span class="font-bold">"{{ activeFilter }}"</span> category.</p>
      <button @click="$emit('clear-filter')" class="mt-4 text-blue-500 underline">Show all products</button>
    </div>
        <div v-if="loading" class="text-center py-10">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
  <template v-for="product in filteredProducts" :key="product?.id">
    <ProductCard
      v-if="product && typeof product === 'object' && product.id"
      :product="product"
    />
  </template>
</div>
  </div>
</template>
