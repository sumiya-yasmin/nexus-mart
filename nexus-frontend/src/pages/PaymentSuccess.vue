<script setup>
import { useRoute } from 'vue-router';
import { onMounted, ref } from 'vue';

const route = useRoute();
const trxId = ref('BK' + Math.random().toString(36).substr(2, 9).toUpperCase());
const amount = route.query.amount || 0;
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8 text-center border border-gray-100">
      <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>

      <h2 class="text-3xl font-bold text-gray-800 mb-2">Payment Successful!</h2>
      <p class="text-gray-500 mb-8">Your order for NexusMart has been placed.</p>

      <div class="bg-gray-50 rounded-2xl p-6 mb-8 space-y-4 text-left">
        <div class="flex justify-between">
          <span class="text-gray-400">Amount Paid</span>
          <span class="font-bold text-gray-800">৳ {{ Number(amount).toLocaleString() }}</span>
        </div>
        <div class="flex justify-between">
          <span class="text-gray-400">Transaction ID</span>
          <span class="font-mono text-sm font-bold text-pink-600">{{ trxId }}</span>
        </div>
        <div class="flex justify-between">
          <span class="text-gray-400">Method</span>
          <span class="font-bold text-gray-800 capitalize">{{ route.query.method }}</span>
        </div>
      </div>

      <router-link to="/" class="block w-full py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg">
        Continue Shopping
      </router-link>
    </div>
  </div>
</template>