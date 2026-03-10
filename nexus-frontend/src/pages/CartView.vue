<script setup>
import { useCartActions } from "@/composable/useCartActions";
import { useOrder } from "@/composable/useOrder";
import { useCartStore } from "@/store/cart";
import { ref } from "vue";

const cartStore = useCartStore();
const { removeFromCartWithNotify } = useCartActions();

const getDiscount = (product) => {
  if (!product.old_price) return 0;
  return Math.round(
    ((product.old_price - product.price) / product.old_price) * 100,
  );
};
const increment = (product) => {
  product.cart_quantity++;
};
const decrement = (product) => {
  if (product.cart_quantity > 1) {
    product.cart_quantity--;
  }
};
const { placeOrder } = useOrder();
const address = ref("");
const paymentMethods = [
  { id: "cash", label: "Pay in Shop" },
  { id: "cod", label: "Cash on Delivery" },
];
const selectedPaymentMethod = ref("cod");
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 pt-4 bg-gray-100">
    <h2
      class="text-2xl text-center font-bold mb-2 py-4 border-b border-gray-300"
    >
      Shopping Cart
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
    <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start p-8">
      <div class="lg:col-span-2 space-y-8">
        <div
          v-for="product in cartStore.items"
          :key="product.id"
          class="p-10 bg-white rounded-xl max-w-2xl"
        >
          <div
            class="flex flex-col md:flex-row justify-between items-center gap-4"
          >
            <div
              class="bg-white w-full md:w-32 h-32 p-6 rounded-2xl border border-slate-100 shadow-sm"
            >
              <img :src="product.image" class="w-full h-full object-contain" />
            </div>
            <div class="md:col-span-2 flex flex-col gap-2 justify-center">
              <h2 class="text-lg text-black-400 font-semibold">
                {{ product.name }}
              </h2>
              <p class="text-bold text-sm">{{ product.description }}</p>
              <div
                class="flex items-center justify-start gap-4 border-t border-b py-4 border-gray-100"
              >
                <span class="font-bold text-black-500 text-lg"
                  >৳ {{ product.price?.toLocaleString() }}</span
                ><span v-if="product.old_price" class="text-sm line-through"
                  >৳ {{ product.old_price?.toLocaleString() }}</span
                ><span
                  v-if="getDiscount(product) > 0"
                  class="bg-orange-100 text-orange-600 px-3 py-1 rounded-lg text-xs font-bold"
                >
                  {{ getDiscount(product) }}% OFF
                </span>
              </div>
            </div>
            <div class="flex flex-col items-center gap-8">
              <div>
                <button
                  class="py-2 px-2 rounded-l-xl border border-slate-200 hover:bg-gray-100"
                  @click="decrement(product)"
                >
                  -
                </button>
                <input
                  v-model.number="product.cart_quantity"
                  type="number"
                  class="w-8 text-center border border-slate-200 py-2 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                />
                <button
                  class="py-2 px-2 rounded-r-xl border border-slate-200 hover:bg-gray-100"
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
                class="px-3 py-2 bg-red-600 text-white rounded-xl text-lg shadow-lg hover:bg-red-500"
              >
                Remove
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="bg-white p-6 rounded-2xl border border-gray-100 shadow-lg sticky top-6"
      >
        <h3 class="text-xl font-bold mb-6">Order Summary</h3>
        <div
          v-if="cartStore.items.length > 0"
          class="p-6 bg-slate-50 flex flex-col border-t border-gray-300 justify-center items-start"
        >
          <div class="flex flex-col">
            <span class="text-sm font-semibold text-gray-400"
              >Total Items: {{ cartStore.totalItems }}</span
            >

            <span class="text-sm font-semibold"
              >GrandTotal: ৳
              {{ cartStore.cartTotalPrice.toLocaleString() }}</span
            >
            <span
              class="text-sm font-semibold bg-orange-100 text-orange-600 p-1 rounded-lg text-xs font-bold mt-1 w-fit"
              >Saved: ৳
              {{ cartStore.cartTotalDiscountedPrice.toLocaleString() }}</span
            >
          </div>
      
            <div class="mt-4 w-full">
              <label class="block text-sm font-medium text-gray-700 mb-3"
                >Payment Method</label
              >

              <div class="space-y-3">
                <label
                  v-for="method in paymentMethods"
                  :key="method.id"
                  class="flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all"
                  :class="
                    selectedPaymentMethod === method.id
                      ? 'border-blue-600 bg-blue-50'
                      : 'border-gray-100'
                  "
                >
                  <input
                    type="radio"
                    :value="method.id"
                    v-model="selectedPaymentMethod"
                    class="sr-only"
                  />

                  <div
                    class="w-5 h-5 rounded-full border-2 mr-4 flex items-center justify-center"
                    :class="
                      selectedPaymentMethod === method.id
                        ? 'border-blue-600'
                        : 'border-gray-300'
                    "
                  >
                    <div
                      v-if="selectedPaymentMethod === method.id"
                      class="w-2.5 h-2.5 bg-blue-600 rounded-full"
                    ></div>
                  </div>

                  <span class="font-bold text-gray-700">{{
                    method.label
                  }}</span>
                </label>
              </div>
            </div>
          </div>
          <div class="mt-4 w-full max-w-md">
            <label class="block text-sm font-medium text-gray-700"
              >Shipping Address</label
            >
            <textarea
              v-model="address"
              placeholder="Enter your full address..."
              class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
              rows="2"
            ></textarea>
            <button
              class="px-6 py-2 font-semibold bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-sm mt-6 disabled:bg-gray-400"
              :disabled="!address"
              @click="placeOrder(address, selectedPaymentMethod)"
            >
              {{ loading ? "Processing..." : "Checkout" }}
            </button>
          </div>
        </div>
    </div>
  </div>
</template>
