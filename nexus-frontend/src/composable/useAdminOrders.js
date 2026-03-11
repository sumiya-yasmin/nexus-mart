import {
  getAllOrders,
  updateOrderPaymentStatus,
  updateOrderStatus,
} from "@/api/admin/adminOrderService";
import { ref } from "vue";

export function useAdminOrders() {
  const orders = ref([]);
  const loading = ref(false);
  const error = ref(null);

  const fetchOrders = async () => {
    loading.value = true;
    try {
      orders.value = await getAllOrders();
    } catch (error) {
      error.value = "Failed to load orders.";
    } finally {
      loading.value = false;
    }
  };

  const updateStatus = async (orderId, status) => {
    try {
      await updateOrderStatus(orderId, status);
      fetchOrders();
    } catch (error) {
      toast.error(`Error updating status: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
    }
  };
  const updatePaymentStatus = async (orderId, status) => {
    try {
      await updateOrderPaymentStatus(orderId, status);
      fetchOrders();
    } catch (error) {
      toast.error(`Error updating status: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
    }
  };
  return {
    loading,
    error,
    orders,
    fetchOrders,
    updateStatus,
    updatePaymentStatus,
  };
}
