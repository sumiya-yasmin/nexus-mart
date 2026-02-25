<script setup>
import { onMounted, onUnmounted, ref } from "vue";
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
let autoPlayInterval= null;
onMounted(()=>{
  autoPlayInterval=setInterval(nextSlide,3000);
});
onUnmounted(()=>{
  clearInterval(autoPlayInterval);
})
</script>
<template>
  <div class="relative w-full max-w-4xl mx-auto overflow-hidden group">
    <button
      @click="prevSlide"
      class="absolute text-xl left-4 z-10 top-1/2 -translate-y-1/2 bg-white/50 p-2 rounded-full hover:bg-white transition"
    >
      <
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
      class="absolute text-xl right-4 top-1/2 -translate-y-1/2 bg-white/50 p-2 z-10 rounded-full hover:bg-white transition"
    >
      >
    </button>
    <div class="absolute bottom-4 z-10 left-1/2 -translate-x-1/2 flex space-x-2">
       <div v-for="_slide,index in slides" :key="index"
       class="w-2.5 h-2.5 rounded-full cursor-pointer "
       :class="currentIndex==index?'bg-blue-400':'bg-white'"
       @click="currentIndex=index"
       >       
       </div>
 
    </div>
  </div>
</template>
