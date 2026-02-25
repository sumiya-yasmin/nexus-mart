<script setup>
defineProps({
  slide: {
    type: Object,
    required: true,
  },
});
</script>
<template>
  <div
    class="max-w-4xl h-[400px] flex m-4 justify-between items-center shadow-lg overflow-hidden text-white px-4"
    :class="slide.theme"
  >
    <div class="w-1/2 p-10 flex flex-col items-start space-y-4">
      <span
        class="bg-white/30 block px-3 py-2 rounded-full text-xs uppercase tracking-wider"
      >
        {{ slide.tag }}
      </span>
      <div class="flex flex-col space-y-2">
        <h2 class="font-black text-2xl">{{ slide.title }}</h2>
        <div v-if="slide.discount" class="bg-yellow-400 text-black px-4 py-1 rounded font-black uppercase text-sm italic">
                {{ slide.discount }}
            </div>
        <p class="font-bold">{{ slide.subtitle }}</p>
      </div>
      <button
        class="mt-4 bg-white text-gray-900 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition"
      >
        {{ slide.buttonText }}
      </button>
    </div>
    <img
      :src="slide.image"
      :alt="slide.title"
      class="w-1/2 relative h-auto object-cover rounded-md"
    />
  </div>
</template>
