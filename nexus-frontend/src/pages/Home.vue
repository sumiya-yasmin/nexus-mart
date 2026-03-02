<script setup>
import CategoryRow from '@/components/CategoryRow.vue';
import FeaturedProducts from '@/components/FeaturedProducts.vue';
import HeroSlider from '@/components/HeroSlider.vue';
import { useProductStore } from '@/store/product';
import { ref } from 'vue';

const currentFilter = ref('');
const productStore = useProductStore();
const masterReset = () => {
    currentFilter.value = '';
    productStore.searchQuery = '';
}
</script>
<template>
    <HeroSlider />
    <CategoryRow
    :activeFilter="currentFilter"
    @category-filter="(slug)=> currentFilter=slug"/>
    <FeaturedProducts :activeFilter="currentFilter"
    @clear-filter="masterReset"
    />
</template>