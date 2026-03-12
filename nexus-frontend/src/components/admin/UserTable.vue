<script setup>
import { useAdminUsers } from '@/composable/useAdminUsers';
import { Delete, DeleteIcon, Trash2 } from 'lucide-vue-next';
import { onMounted } from 'vue';

const { loading,
    users,
    fetchUsers,
    updateUserRole,
    removeUser } = useAdminUsers();
onMounted(() => {
    fetchUsers();
});
</script>
<template>
  <div class="p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold mb-4">NexusMart Users</h2>

    <div v-if="loading" class="text-rose-500">Loading Users.....</div>
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="border-b bg-gray-50">
          <th class="p-3">User Id</th>
          <th class="p-3">Name</th>
          <th class="p-3">Email</th>
          <th class="p-3">Role</th>
          <th class="p-3">Join Date</th>
          <th class="p-3 text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="user in users"
          :key="user.id"
          class="border-b hover:bg-gray-50"
        >
          <td class="p-3 font-mono">
              #NEXUS-{{ user.id }}
          </td>
          <td class="p-3">{{ user.name }}</td>
          <td class="p-3">{{ user.email }}</td>
          <td class="p-3">
            <span
              :class="{
                'px-2 py-1 rounded text-xs font-bold uppercase': true,
                'bg-yellow-100 text-yellow-700':
                  user.role === 'customer',
                'bg-green-100 text-green-700': user.role === 'admin',
              }"
            >
              {{ user.role}}
            </span>
          </td>
        <td class="p-3">{{new Date(user.created_at).toLocaleDateString() }}</td>
          <td class="p-3">
            <div class="flex items-center space-x-3">
              <select
                class="border rounded p-1 text-xs w-fit bg-white"
                @change="updateUserRole(user.id, $event.target.value)"
                :value="user.role"
              >
                <option>Change User Role</option>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
              </select>
              <button
              @click="removeUser(user.id)"
                class="flex items-center text-red-600 hover:text-red-800 font-medium transition-colors"
              >
                <Trash2 />
            </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
