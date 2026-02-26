<script setup>
const currentYear = new Date().getFullYear();
</script>
<template>
  <footer class="bg-gray-800 pt-16 pb-16 mt-20">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
      <div class="col-span-1 md:col-span-1">
        <h2 class="text-2xl font-black text-white mb-4">NEXUS<span class="text-blue-600">MART</span></h2>
        <p class="text-slate-400 text-sm leading-relaxed">
          Your one-stop destination for the latest gadgets in Dhaka. Premium quality, fastest delivery.
        </p>
      </div>

      <div>
        <h3 class="font-bold text-white mb-4">Shop</h3>
        <ul class="space-y-2 text-sm text-slate-400">
          <li class="hover:text-blue-600 cursor-pointer">All Products</li>
          <li class="hover:text-blue-600 cursor-pointer">Gaming Gear</li>
          <li class="hover:text-blue-600 cursor-pointer">Smartphones</li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold text-white mb-4">Support</h3>
        <ul class="space-y-2 text-sm text-slate-400">
          <li class="hover:text-blue-600 cursor-pointer">Order Tracking</li>
          <li class="hover:text-blue-600 cursor-pointer">Warranty Policy</li>
          <li class="hover:text-blue-600 cursor-pointer">Contact Us</li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold text-white mb-4">Contact</h3>
        <p class="text-sm text-slate-400 mb-2">Sector 11, Uttara, Dhaka</p>
        <p class="text-sm text-slate-400 font-bold">Hotline: 01XXX-XXXXXX</p>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 mt-16 pt-8 border-t border-slate-700 text-center text-xs text-slate-400">
      &copy; {{ currentYear }} NexusMart. All rights reserved.
    </div>
  </footer>
</template>