<script setup>
import { categoriesList } from "@/data/categories";
import { ref } from "vue";
const categories = ref(categoriesList);
const scrollContainer = ref(null);
const scrollLeft = () =>{
  if(scrollContainer.value){
    scrollContainer.value.scrollBy({left: -300, behavior: "smooth"})
  }
}
const scrollRight = ()=>{
if(scrollContainer.value){
    scrollContainer.value.scrollBy({left: 300, behavior: "smooth"})
  }
}
</script>
<template>
  <div
    class="relative flex gap-2 max-w-7xl mx-auto py-8 px-4 my-8"
    

  >
    <button
      @click="scrollLeft"
      class="absolute border text-xl left-4 z-10 top-1/2 -translate-y-1/2 bg-white/50 p-2 rounded-full hover:bg-blue-400 transition cursor-pointer"
    >
      <
    </button>
    <div class=" max-w-6xl flex flex-nowrap gap-8 mx-auto overflow-x-auto scroll-smooth [&::-webkit-scrollbar]:hidden py-4" ref="scrollContainer">
    <div
      v-for="category in categories"
      class="flex flex-col bg-white w-40 shrink-0 items-center justify-center p-6 bg-gray-50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 cursor-pointer group"
    >
      <h2 class="font-black">{{ category.name }}</h2>
      <div
        class="w-20 h-20 mb-4 rounded-full overflow-hidden bg-white shadow-sm group-hover:scale-110 transition-transform duration-300"
      >
        <img
          :src="category.image"
          :alt="category.name"
          class="w-full h-full object-cover"
        />
      </div>
    </div>
    </div>
    <button
      @click="scrollRight"
      class="absolute border text-xl right-4 top-1/2 -translate-y-1/2 bg-white/50 p-2 z-10 rounded-full hover:bg-blue-400 transition cursor-pointer"
    >
      >
    </button>
  </div>
</template>
