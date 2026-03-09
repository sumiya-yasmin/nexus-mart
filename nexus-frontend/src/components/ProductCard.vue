<script setup>
import { useCartActions } from '@/composable/useCartActions';
import { computed } from 'vue';

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});
const discount = computed(() => {
  return props.product.old_price
    ? Math.round(
      ((props.product.old_price - props.product.price) /
        props.product.old_price) *
      100,
    )
    : 0;
});
const { addToCartWithNotify } = useCartActions();
</script>
<template>
  <router-link v-if="product && product.slug" :to="`/product/${product.slug}`" class="group">
  <div
    class="bg-white flex flex-col h-full border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl transition-shadow"
  >
    <div class="relative">
      <div
        v-if="product.old_price && product.old_price > product.price"
        class="absolute top-0 left-0 z-10 bg-orange-400 px-3 py-1 rounded-br-xl font-bold uppercase text-[10px] text-white"
      >
        Save {{ product.old_price - product.price }}৳ (-{{ discount }}%)
      </div>

      <div class="w-full h-48 flex items-center justify-center overflow-hidden">
        <img
          v-if="product.image"
          :src="product.image"
          :alt="product.name"
          class="w-full h-full object-cover p-4"
        />
        <div
          v-else
          class="text-slate-300 bg-slate-50 flex flex-col items-center"
        >
          <span class="text-[10px]">No Image</span>
        </div>
      </div>
    </div>
    <div class="border-t p-4 border-slate-200">
      <h2
        class="font-bold text-sm uppercase text-slate-800 line-clamp-2 h-10 mb-2"
      >
        {{ product.name }}
      </h2>
      <div class="flex items-center">
        <span class="text-red-700 font-bold"
          >{{ Number(product?.price || 0).toLocaleString() }}৳</span
        >
        <span
          v-if="product.old_price && product.old_price > product.price"
          class="text-xs ml-2 line-through"
          >{{ Number(product.old_price).toLocaleString() }}৳</span
        >
      </div>
     <button 
     @click.prevent="addToCartWithNotify(product,1)"
     class="w-full z-50 mt-3 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-slate-600 transition">
            Add to Cart
        </button>
    </div>
  </div>
  </router-link>
</template>
