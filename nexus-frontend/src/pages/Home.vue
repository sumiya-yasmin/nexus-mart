<script setup>
import CategoryRow from '@/components/CategoryRow.vue';
import FeaturedProducts from '@/components/FeaturedProducts.vue';
import HeroSlider from '@/components/HeroSlider.vue';
import { ref } from 'vue';

const currentFilter = ref('');

</script>
<template>
    <HeroSlider />
    <CategoryRow
    :activeFilter="currentFilter"
    @category-filter="(slug)=> currentFilter=slug"/>
    <FeaturedProducts :activeFilter="currentFilter"
    @clear-filter="currentFilter=''"
    />
</template>