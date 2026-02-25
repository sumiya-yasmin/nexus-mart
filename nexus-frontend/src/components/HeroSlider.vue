<script setup>
import { ref } from "vue";
import HeroCard from "./HeroCard.vue";
import { heroSlides } from "@/data/heroSlides";
const slides = ref(heroSlides);
const currentIndex = ref(0);
const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.value.length;
};
const prevSlide = () => {
  currentIndex.value =
    currentIndex.value == 0 ? slides.value.length - 1 : currentIndex.value - 1;
};
</script>
<template>
  <div class="relative w-full max-w-4xl mx-auto overflow-hidden group">
    <button
      @click="prevSlide"
      class="absolute left-4 z-10 top-1/2 -translate-y-1/2 bg-white/50 p-2 rounded-full hover:bg-white transition"
    >
      ⬅️
    </button>
    <div
      class="flex transition-transform duration-700 ease-in-out"
      :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
    >
      <HeroCard
        v-for="slide in slides"
        :key="slide.id"
        :slide="slide"
        class="min-w-full"
      />
    </div>
    <button
      @click="nextSlide"
      class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/50 p-2 z-10 rounded-full hover:bg-white transition"
    >
      ➡️
    </button>
    <div class="absolute bottom-4 z-10 left-1/2 -translate-x-1/2 flex space-x-2">
 abcdrft
 
    </div>
  </div>
</template>
