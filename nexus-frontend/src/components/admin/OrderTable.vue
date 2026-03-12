<script setup>
import { useAdminOrders } from "@/composable/useAdminOrders";
import { EyeIcon } from "lucide-vue-next";
import { onMounted } from "vue";
const {
  loading,
  error,
  orders,
  fetchOrders,
  updateStatus,
  updatePaymentStatus,
} = useAdminOrders();
onMounted(() => {
  fetchOrders();
});
</script>
<template>
  <div class="p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold mb-4">NexusMart Orders</h2>

    <div v-if="loading" class="text-rose-500">Updating inventory...</div>
    <div v-if="orders.length===0">No Orders made Yet</div>
    <table v-else class="w-full text-left border-collapse">
      <thead>
        <tr class="border-b bg-gray-50">
          <th class="p-3">Order Id</th>
          <th class="p-3">Customer</th>
          <th class="p-3">Total</th>
          <th class="p-3">Payment Status</th>
          <th class="p-3">Status</th>
          <th class="p-3 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="order in orders"
          :key="order.id"
          class="border-b hover:bg-gray-50"
        >
          <td class="p-3 font-mono">
            <router-link
              :to="{ name: 'admin-order-detail', params: { id: order.id } }"
              class="text-blue-600 hover:underline cursor-pointer"
            >
              #NEXUS-{{ order.id }}
            </router-link>
          </td>
          <td class="p-3">{{ order.user?.name }}</td>
          <td class="p-3">{{ order.total_price }}</td>
          <td class="p-3">
            <span
              :class="{
                'px-2 py-1 rounded text-xs font-bold uppercase': true,
                'bg-yellow-100 text-yellow-700':
                  order.payment_status === 'unpaid',
                'bg-green-100 text-green-700': order.payment_status === 'paid',
              }"
            >
              {{ order.payment_status }}
            </span>
          </td>
          <td class="p-3">
            <span
              :class="{
                'px-2 py-1 rounded text-xs font-bold uppercase': true,
                'bg-yellow-100 text-yellow-700': order.status === 'pending',
                'bg-orange-100 text-orange-700': order.status === 'processing',
                'bg-blue-100 text-blue-700': order.status === 'shipped',
                'bg-green-100 text-green-700': order.status === 'delivered',
                'bg-red-100 text-red-700': order.status === 'cancelled',
              }"
            >
              {{ order.status }}
            </span>
          </td>
          <td class="p-3">
            <div class="flex items-center space-x-3">
              <select
                class="border rounded p-1 text-xs w-fit bg-white"
                @change="updatePaymentStatus(order.id, $event.target.value)"
                :value="order.payment_status"
              >
                <option>Change Pay Status</option>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
              </select>

              <select
                class="border rounded p-1 text-xs w-fit bg-white"
                @change="updateStatus(order.id, $event.target.value)"
                :value="order.status"
              >
                <option>Change Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
              <router-link
                :to="{ name: 'admin-order-detail', params: { id: order.id } }"
                class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors"
              >
                <EyeIcon />
              </router-link>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
