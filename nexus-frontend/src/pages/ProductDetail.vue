<script setup>
import { useCartActions } from "@/composable/useCartActions";
import { useProductData } from "@/composable/useProduct";
import { computed, onMounted, ref } from "vue";

const { loading, error, product, loadProductData } = useProductData();
onMounted(() => {
  loadProductData();
});
const discount = computed(() => {
  if (!product.value || !product.value.old_price) return 0;
  const oldPrice = product.value.old_price;
  return Math.round(((oldPrice - product.value.price) / oldPrice) * 100);
});
const quantity = ref(1);
const increment = () => {
  quantity.value++;
};
const decrement = () => {
  if (quantity.value > 1) {
    quantity.value--;
  }
};
const { addToCartWithNotify } = useCartActions();
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 pt-4">
    <router-link to="/">
      <div class="px-4 py-2 bg-blue-500 text-white w-fit rounded-md mb-4">
        <span class="text-xl font-bold text-gray-200">< </span
        ><span>Back to HomePage</span>
      </div>
    </router-link>
    <div v-if="loading" class="text-center py-20">Loading Product...</div>
    <div v-else-if="product" class="">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
          <img :src="product.image" class="w-full h-auto max-h-[500px]" />
        </div>
        <div class="md:col-span-2 flex flex-col gap-2 justify-center">
          <h2 class="text-4xl text-blue-400 font-semibold">
            {{ product.name }}
          </h2>
          <p class="text-bold text-xl">{{ product.description }}</p>
          <div
            class="flex items-center justify-start gap-4 border-t border-b py-4 border-gray-100"
          >
            <span class="font-bold text-blue-500 text-2xl"
              >৳ {{ product.price?.toLocaleString() }}</span
            ><span v-if="product.old_price" class="text-xl line-through"
              >৳ {{ product.old_price?.toLocaleString() }}</span
            ><span
              v-if="discount > 0"
              class="bg-orange-100 text-orange-600 px-3 py-1 rounded-lg text-sm font-bold"
            >
              {{ discount }}% OFF
            </span>
          </div>
          <div class="flex gap-4 items-center">
            <span>Rating :</span>
            <div class="flex items-center gap-2">
              <div v-for="n in 5" :key="n">
                <span v-if="n <= product.rating" class="text-orange-300"
                  >★</span
                >
                <span v-else class="text-gray-400">★</span>
              </div>
              <span class="ml-2 text-slate-500 text-sm"
                >({{ product.rating }}/5)</span
              >
            </div>
          </div>
        </div>
      </div>
      <div
        class="flex flex-col md:flex-row items-center justify-center gap-8 py-16 mt-16 border-y border-slate-100"
      >
        <div>
          <button
            class="py-4 px-4 border border-slate-200 hover:bg-gray-100"
            @click="decrement"
          >
            -
          </button>
          <input
            v-model.number="quantity"
            type="number"
            class="w-12 text-center border border-slate-200 py-4 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
          />
          <button
            class="py-4 px-4 border border-slate-200 hover:bg-gray-100"
            @click="increment"
          >
            +
          </button>
        </div>
        <button
          @click="
            () => {
              console.log('Button Clicked!', product, quantity);
              addToCartWithNotify(product, quantity);
            }
          "
          class="px-4 py-4 z-50 bg-slate-900 text-white font-bold rounded-xl text-xl shadow-lg hover:bg-slate-800 w-full md:w-64"
        >
          Add to Cart
        </button>
      </div>
      <div
        class="bg-slate-50 rounded-2xl p-12 text-center border-2 border-dashed border-slate-200"
      >
        <h4 class="text-lg font-semibold text-slate-700">No reviews yet</h4>
        <p class="text-slate-500 max-w-xs mx-auto mt-2">
          Be the first to share your thoughts about the {{ product.name }}!
        </p>
      </div>
    </div>
  </div>
</template>
