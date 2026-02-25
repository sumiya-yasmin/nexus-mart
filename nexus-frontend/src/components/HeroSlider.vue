<script setup>
import HeroCard from './HeroCard.vue';
import { heroSlides } from '@/data/heroSlides';
const slides = heroSlides;
</script>
<template>
    <div class="px-12 flex items-center justify-center flex-col gap-4">
        <HeroCard v-for="slide in slides" :key="slide.id" :slide="slide"/>
    </div>
</template>