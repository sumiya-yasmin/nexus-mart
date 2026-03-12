import {
  deleteUser,
  getAllUsers,
  updateUser,
} from "@/api/admin/adminUserService";
import { ref } from "vue";
import { useToast } from "vue-toastification";

export function useAdminUsers() {
  const users = ref([]);
  const loading = ref(false);
  const error = ref(null);
  const toast = useToast();

  const fetchUsers = async () => {
    loading.value = true;
    try {
      users.value = await getAllUsers();
    } catch (error) {
      error.value = "Failed to load users.";
    } finally {
      loading.value = false;
    }
  };

  const updateUserRole = async (userId, newRole) => {
    try {
      await updateUser(userId, { role: newRole });
      fetchUsers();
    } catch (error) {
      toast.error(`Error updating user: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
    }
  };

  const removeUser = async (userId) => {
    try {
      await deleteUser(userId);
      fetchUsers();
    } catch (error) {
      toast.error(`Error removing user: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
    }
  };
  return {
    loading,
    error,
    users,
    fetchUsers,
    updateUserRole,
    removeUser,
  };
}
