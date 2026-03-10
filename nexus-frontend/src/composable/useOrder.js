import { createOrder, getOrders } from "@/api/orderService";
import { useCartStore } from "@/store/cart";
import { ref } from "vue";
import { useToast } from "vue-toastification";

export function useOrder() {
  const cartStore = useCartStore();
  const loading = ref(false);
  const error = ref(null);
  const toast = useToast();
  const orders = ref([]);

  const placeOrder = async (address, paymentMethod) => {
    loading.value = true;
    error.value = null;
    try {
      const orderData = {
        items: cartStore.items,
        total_price: cartStore.cartTotalPrice,
        address: address,
        payment_method: paymentMethod,
      };
      const response = await createOrder(orderData);
      toast.success("Your order is placed successfully", {
        timeout: 2000,
        position: "top-right",
      });
      cartStore.clearCart();
      return response.data;
    } catch (err) {
      error.value = err.response?.data?.message || "Something went wrong";
      throw err;
    } finally {
      loading.value = false;
    }
  };
  const fetchOrders = async () => {
    loading.value = true;
    error.value = null;
    try {
      const response = await getOrders();
      orders.value = response.data;
      return response.data;
    } catch (err) {
      error.value = err.response?.data?.message || "Something went wrong";
      throw err;
    } finally {
      loading.value = false;
    }
  }
  return { loading, error, placeOrder, fetchOrders, orders };
}
