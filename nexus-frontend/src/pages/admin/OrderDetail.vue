
<script setup>
import { useAdminOrders } from '@/composable/useAdminOrders';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const {
    order,
    detailPageLoading,
    fetchOrderDetails,
} = useAdminOrders();

onMounted(() => {
  fetchOrderDetails(route.params.id);
});
</script>
<template>
  <div class="p-6 max-w-6xl mx-auto">
    <div v-if="detailPageLoading" class="text-center py-10 text-rose-500">Loading Order Details...</div>
    
    <div v-else-if="order" class="space-y-6">
      <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm">
        <div>
          <h1 class="text-xl font-bold text-gray-800">Order #NEXUS-{{ order.id }}</h1>
          <p class="text-sm text-gray-500 font-mono">{{ new Date(order.created_at).toLocaleString() }}</p>
        </div>
        <div class="text-right">
          <span class="block text-sm uppercase text-gray-400 font-bold mb-2">Status</span>
          <span class="px-4 py-2 text-center rounded-full text-sm font-bold bg-violet-100 text-violet-700 uppercase">
            {{ order.status }}
          </span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm space-y-4">
          <h3 class="font-bold border-b pb-2 text-gray-700">Customer Details</h3>
          <div>
            <p class="text-xs text-gray-400 uppercase">Name</p>
            <p class="font-medium">{{ order.user?.name }}</p>
          </div>
          <div>
            <p class="text-xs text-gray-400 uppercase">Email</p>
            <p class="font-medium">{{ order.user?.email }}</p>
          </div>
          <div>
            <p class="text-xs text-gray-400 uppercase">Shipping Address</p>
            <p class="font-medium">{{ order.address }}</p>
          </div>
        </div>

        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm">
          <h3 class="font-bold border-b pb-2 mb-4 text-gray-700">Order Items</h3>
          <table class="w-full text-left">
            <thead>
              <tr class="text-xs text-gray-400 uppercase border-b">
                <th class="pb-3">Product</th>
                <th class="pb-3 text-center">Qty</th>
                <th class="pb-3 text-right">Price</th>
                <th class="pb-3 text-right">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in order.items" :key="item.id" class="border-b last:border-0">
                <td class="py-4">
                  <p class="font-medium text-gray-800">{{ item.product?.name }}</p>
                </td>
                <td class="py-4 text-center">{{ item.quantity }}</td>
                <td class="py-4 text-right">${{ item.product?.price }}</td>
                <td class="py-4 text-right font-bold text-violet-600">
                  ${{ (item.quantity * item.product?.price).toFixed(2) }}
                </td>
              </tr>
            </tbody>
          </table>

          <div class="mt-6 border-t pt-4 text-right">
            <span class="text-gray-500 mr-4">Grand Total:</span>
            <span class="text-xl font-black text-gray-800">${{ order.total_price }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

