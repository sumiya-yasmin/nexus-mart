<script setup>
import { useAdminOrders } from '@/composable/useAdminOrders';
import { useAdminUsers } from '@/composable/useAdminUsers';
import { Clock, DollarSign, ShoppingBag, UsersIcon } from 'lucide-vue-next';
import { computed, onMounted } from 'vue';

const { users, fetchUsers } = useAdminUsers();
const { orders, fetchOrders } = useAdminOrders();
onMounted(() => {
    fetchOrders();
    fetchUsers();
})
const total_revenue = computed(() => {
    const total = orders.value.reduce((acc, curr) => {
        return acc + parseFloat(curr.total_price || 0)
    }, 0)
    return total.toLocaleString();
})  
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Admin Overview</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                    <UsersIcon :size="24" />
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Customers</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ users.length }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-rose-100 rounded-lg text-rose-600">
                    <ShoppingBag :size="24" />
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ orders.length }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-green-100 rounded-lg text-green-600">
                    <DollarSign :size="24" />
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-800">৳{{ total_revenue }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4">
                <div class="p-3 bg-amber-100 rounded-lg text-amber-600">
                    <Clock :size="24" />
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pending Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ orders.filter(o => o.status === 'pending').length }}</h3>
                </div>
            </div>
        </div>
    </div>
</template>