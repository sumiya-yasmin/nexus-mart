import {
  getAllOrders,
  getOrderById,
  updateOrderPaymentStatus,
  updateOrderStatus,
} from "@/api/admin/adminOrderService";
import { ref } from "vue";
import { useToast } from "vue-toastification";
const toast = useToast();
export function useAdminOrders() {
  const orders = ref([]);
  const order = ref(null);
  const loading = ref(false);
  const error = ref(null);
  const detailPageLoading = ref(false);
  const detailPageError = ref(null);

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

  const fetchOrderDetails = async (id) => {
    detailPageLoading.value = true;
    detailPageError.value = null;
    try {
      order.value = await getOrderById(id);
    } catch (err) {
      detailPageError.value = "Could not load order details.";
    } finally {
      detailPageLoading.value = false;
    }
  };

  const updateStatus = async (orderId, status) => {
    const orderIndex = orders.value.findIndex((o) => o.id === orderId);

    if (orderIndex !== -1) {
      orders.value[orderIndex].status = status;
    }
    try {
      await updateOrderStatus(orderId, status);
    } catch (error) {
      toast.error(`Error updating status: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
      await fetchOrders();
    }
  };
  const updatePaymentStatus = async (orderId, status) => {
    const orderIndex = orders.value.findIndex((o) => o.id === orderId);
    if (orderIndex !== -1) {
      orders.value[orderIndex].payment_status = status;
    }
    try {
      await updateOrderPaymentStatus(orderId, status);
    } catch (error) {
      toast.error(`Error updating status: ${error.message}`, {
        timeout: 1000,
        position: "bottom-right",
      });
      await fetchOrders();
    }
  };
    return {
    order,
    loading,
    error,
    orders,
    fetchOrders,
    updateStatus,
    updatePaymentStatus,
    detailPageLoading,
    detailPageError,
    fetchOrderDetails,
  };
}
