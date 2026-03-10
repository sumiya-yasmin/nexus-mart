<script setup>
import { useOrder } from "@/composable/useOrder";
import { onMounted } from "vue";

const { loading, error, fetchOrders, orders } = useOrder();
onMounted(() => {
  fetchOrders();
});
</script>

<template>
  <div class="max-w-7xl mx-auto p-6 bg-gray-100">
    <div class="flex items-center justify-between mb-8 max-w-2xl mx-auto">
      <h1 class="text-3xl font-black text-gray-900 tracking-tight">
        My Orders
      </h1>
      <span
        class="bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-bold border border-blue-100"
      >
        Total Orders: {{ orders.length }}
      </span>
    </div>
    <div v-if="loading" class="flex flex-col items-center justify-center py-20">
      <div
        class="w-12 h-12 border-4 border-blue-100 border-t-blue-600 rounded-full animate-spin-slow mb-4"
      ></div>
      <p class="text-gray-500 animate-pulse">Fetching your orders...</p>
    </div>
    <div
      v-else-if="orders.length > 0"
      class="grid grid-cols-1 gap-10 items-center justify-center p-8"
    >
      <div class="space-y-8">
        <div
          v-for="order in orders"
          :key="order.id"
          class="bg-white rounded-xl max-w-4xl mx-auto"
        >
          <div class="flex flex-col justify-between">
            <div class="flex items-center justify-between gap-8 py-2 px-6">
              <div>
                <p
                  class="text-[10px] uppercase tracking-widest text-gray-400 font-bold"
                >
                  Order Number
                </p>
                <p class="font-mono font-bold text-gray-700">
                  #NEX-{{ order.id }}
                </p>
              </div>
              <div>
                <p
                  class="text-[10px] uppercase tracking-widest text-gray-400 font-bold"
                >
                  Date Placed
                </p>
                <p class="font-bold text-gray-700">
                  {{ new Date(order.created_at).toLocaleDateString() }}
                </p>
              </div>
              <span
                :class="{
                  'bg-amber-100 text-amber-700': order.payment_status === 'unpaid',
                  'bg-green-100 text-green-700': order.payment_status === 'paid',
                }"
                class="px-3 py-1 rounded-lg text-xs text-center font-black uppercase tracking-tighter"
              >
                {{ order.payment_status }}
              </span>
              <span
                :class="{
                  'bg-amber-100 text-amber-700': order.status === 'pending',
                  'bg-green-100 text-green-700': order.status === 'completed',
                  'bg-blue-100 text-blue-700': order.status === 'shipped',
                }"
                class="px-3 py-1 rounded-lg text-xs text-center font-black uppercase tracking-tighter"
              >
                {{ order.status }}
              </span>
            </div>
            <div
              v-for="item in order.items"
              class="flex p-4 justify-center items-center gap-8 bg-slate-50 border-b border-gray-200"
            >
              <div
                class="bg-white w-full md:w-32 h-32 p-6 rounded-2xl border border-slate-100 shadow-sm"
              >
                <img
                  :src="item.product?.image"
                  class="w-full h-full object-contain"
                />
              </div>
              <div class="flex-1">
                <h4 class="font-bold text-gray-800 leading-tight">
                  {{ item.product?.name }}
                </h4>
                <p class="text-sm text-gray-500">
                  {{ item.product?.description }}
                </p>
              </div>
              <div class="flex-1">
                <p class="text-sm text-gray-500">
                  Quantity: {{ item.quantity }} × ৳{{ item.price }}
                </p>
                <p class="font-bold text-gray-700">
                  ৳{{ item.quantity * item.price }}
                </p>
              </div>
            </div>
            <div class="flex justify-between items-center py-2 px-6">
              <div class="flex items-center justify-center gap-2">
                <p
                  class="text-[10px] uppercase tracking-widest text-gray-400 font-bold"
                >
                  Total Amount:
                </p>
                <p class="text-lg font-black">৳{{ order.total_price }}</p>
              </div>
              <div class="flex items-center gap-2 max-w-[50%]">
                <p
                  class="text-[10px] uppercase tracking-widest text-gray-400 font-bold shrink-0"
                >
                  Shipping To:
                </p>
                <div class="flex-1 min-w-0">
                  <p
                    class="text-sm text-gray-600 line-clamp-2 hover:line-clamp-none transition-all cursor-help"
                    title="Click to expand"
                  >
                    {{ order.address }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="text-center py-20 bg-gray-50 rounded-2xl">
      <p class="text-gray-500">You haven't placed any orders yet.</p>
    </div>
    <div
      v-if="error"
      class="text-center py-20 bg-gray-50 text-red-500 rounded-2xl"
    >
      <p class="text-gray-500">{{ error }}</p>
    </div>
  </div>
</template>
