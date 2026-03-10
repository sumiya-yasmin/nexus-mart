<script setup>
import { onMounted, watch } from "vue";
import ProductCard from "./ProductCard.vue";
import { useProducts } from "@/composable/useProduct";
import { useProductStore } from "@/store/product";
import FilterCard from "./FilterCard.vue";
const { products, loading, error, loadProducts } = useProducts();

const productStore = useProductStore();
const props = defineProps(['activeFilter']);
const emit = defineEmits(['clear-filter']);
watch(() => props.activeFilter, (newSlug) => {
  loadProducts(newSlug);
});

let timeout = null;

watch(() => productStore.searchQuery, () => {
  clearTimeout(timeout); 
  timeout = setTimeout(() => {
    loadProducts(props.activeFilter);
  }, 400);
});

onMounted(() => {
  loadProducts(props.activeFilter);
});
const handleReset = () => {
  productStore.resetFilters();
  emit('clear-filter');
  loadProducts();
}
</script>
<template>
  <div class="max-w-7xl mx-auto px-4 pb-12 mt-12 relative">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

  
    <aside class="lg:sticky lg:top-24">
      <FilterCard @filter="loadProducts"/>
    </aside>
    <div class="lg:col-span-3"> 
    <div v-if="activeFilter || productStore.searchQuery || productStore.min_price || productStore.max_price" class="flex justify-end mb-4">
      <button 
        @click="handleReset" 
        class="text-sm bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition"
      >
        ✕ Clear All Filters
      </button>
    </div>
    
    <h2 class="text-xl font-bold mb-10 text-center">Featured Products</h2>
<div v-if="!loading && products.length === 0" class="flex flex-col items-center justify-center py-24 bg-white rounded-3xl border border-dashed border-slate-200">    
    <h3 class="text-xl font-bold text-slate-800 mb-2">No matches found</h3>
    <p class="text-slate-500 text-center max-w-xs mb-6">
        We couldn't find anything for <span class="text-blue-600 font-bold">"{{ productStore.searchQuery }}"</span>. 
        Try checking your spelling or using more general terms.
    </p>
    
    <button @click="handleReset" class="bg-slate-900 text-white px-6 py-2 rounded-full text-sm font-bold hover:bg-blue-600 transition shadow-lg">
        Reset All Filters
    </button>
</div>
        <div v-if="loading" class="text-center py-10">Loading...</div>
    <div v-else-if="error" class="text-red-500">{{ error }}</div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
  <template v-for="product in products" :key="product?.id">
    <ProductCard
      v-if="product && typeof product === 'object' && product.id"
      :product="product"
    />
  </template>
    </div>
</div>
</div>
  </div>
</template>
