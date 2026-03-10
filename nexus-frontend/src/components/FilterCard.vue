<script setup>
import { useProductStore } from "@/store/product";

const productStore = useProductStore();
const emit = defineEmits(['filter']);

const applyFilter = () => {
  emit('filter'); 
};
</script>

<template>
  <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
      <span class="w-1 h-5 bg-blue-600 rounded-full"></span>
      Price Range
    </h3>
    
    <div class="space-y-4">
      <div>
        <label class="text-xs text-slate-400 uppercase font-semibold mb-1 block">Min Price</label>
        <input 
          v-model="productStore.min_price"
          type="number" 
          placeholder="0"
          class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
        />
      </div>

      <div>
        <label class="text-xs text-slate-400 uppercase font-semibold mb-1 block">Max Price</label>
        <input 
          v-model="productStore.max_price"
          type="number" 
          placeholder="Max price you want to enter"
          class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
        />
      </div>

      <button 
        @click="applyFilter"
        class="w-full bg-slate-900 text-white py-2 rounded-lg text-sm font-bold hover:bg-blue-600 transition-colors shadow-lg shadow-slate-200"
      >
        Apply Price Filter
      </button>
    </div>
  </div>
</template>