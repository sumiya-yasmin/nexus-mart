<script setup>
import { useCartActions } from "@/composable/useCartActions";
import { useOrder } from "@/composable/useOrder";
import { useCartStore } from "@/store/cart";

const cartStore = useCartStore();
const { removeFromCartWithNotify } = useCartActions();

const getDiscount = (product) => {
  if (!product.old_price) return 0;
  return Math.round(
    ((product.old_price - product.price) / product.old_price) * 100,
  );
};
const increment = (product) => {
  product.quantity++;
};
const decrement = (product) => {
  if (product.quantity > 1) {
    product.quantity--;
  }
};
const { placeOrder } = useOrder();
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 pt-4">
    <h2 class="text-3xl font-bold mb-2 border-b border-gray-300 py-4">
      Your Shopping Cart
    </h2>
    <div
      v-if="cartStore.items.length === 0"
      class="flex flex-col items-center py-20"
    >
      <p class="text-xl text-gray-500 mb-4">Your cart is currently empty.</p>
      <router-link to="/" class="px-6 py-2 bg-blue-500 text-white rounded-lg">
        Go Shopping
      </router-link>
    </div>
    <div v-for="product in cartStore.items" :key="product.id" class="py-8 px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
          <img :src="product.image" class="w-full h-auto max-h-[500px]" />
        </div>
        <div class="md:col-span-2 flex flex-col gap-2 justify-center">
          <h2 class="text-2xl text-black-400 font-semibold">
            {{ product.name }}
          </h2>
          <p class="text-bold text-xl">{{ product.description }}</p>
          <div
            class="flex items-center justify-start gap-4 border-t border-b py-4 border-gray-100"
          >
            <span class="font-bold text-black-500 text-xl"
              >৳ {{ product.price?.toLocaleString() }}</span
            ><span v-if="product.old_price" class="text-xl line-through"
              >৳ {{ product.old_price?.toLocaleString() }}</span
            ><span
              v-if="getDiscount(product) > 0"
              class="bg-orange-100 text-orange-600 px-3 py-1 rounded-lg text-sm font-bold"
            >
              {{ getDiscount(product) }}% OFF
            </span>
          </div>
          <div class="flex flex-col md:flex-row items-center gap-8">
            <div>
              <button
                class="py-4 px-4 border border-slate-200 hover:bg-gray-100"
                @click="decrement(product)"
              >
                -
              </button>
              <input
                v-model.number="product.quantity"
                type="number"
                class="w-12 text-center border border-slate-200 py-4 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
              />
              <button
                class="py-4 px-4 border border-slate-200 hover:bg-gray-100"
                @click="increment(product)"
              >
                +
              </button>
            </div>
            <button
              @click="
                () => {
                  removeFromCartWithNotify(product);
                }
              "
              class="px-4 py-4 bg-red-700 text-white font-semibold rounded-xl text-xl shadow-lg hover:bg-red-600"
            >
              Remove
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="cartStore.items.length > 0"
      class="mt-8 py-6 px-6 bg-slate-50 flex border-t border-gray-300 justify-center items-center gap-20"
    >
    <div class="flex flex-col">
      <span class="text-xl font-bold"
        >Total Items: {{ cartStore.totalItems }}</span
      >
      
      <span class="text-xl font-semibold text-blue-600"
        >GrandTotal: ৳ {{ cartStore.cartTotalPrice.toLocaleString() }}</span
      >
      <span class="text-xl font-semibold bg-orange-100 text-orange-600 p-1 rounded-lg text-xs font-bold mt-1 w-fit"
        >Saved: ৳ {{ cartStore.cartTotalDiscountedPrice.toLocaleString() }}</span
      >
      <button class="px-6 py-2 font-semibold bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm mt-6"
      @click="placeOrder"
      >
      Checkout
    </button>
    </div>
    
      
    </div>
  </div>
</template>
