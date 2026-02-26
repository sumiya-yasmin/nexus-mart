<script setup>
import { ref } from 'vue';
import ProductCard from './ProductCard.vue';
import { productList } from '@/data/product';
const products = ref(productList);
</script>
<template>
    <div class="max-w-7xl mx-auto px-4 pb-12 mt-12">
<h2 class="text-xl font-bold mb-10 text-center">Featured Products</h2>    
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <ProductCard 
            v-for="product in products" 
            :key="product.id" 
            :product="product"
        />
    </div>
    </div>
</template>