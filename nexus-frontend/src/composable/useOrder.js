import { createOrder } from "@/api/orderService";
import { useCartStore } from "@/store/cart"
import { ref } from "vue";

export function useOrder() {
    const cartStore = useCartStore();
    const loading = ref(false);
    const error = ref(null);

    const placeOrder = async (address) => {
        loading.value = true;
        error.value = null;
        try {
            const orderData = {
                items: cartStore.items,
                total_price: cartStore.total_price,
                address: address,
            }
            const response = await createOrder(orderData);
            cartStore.clearCart();
            return response.data;

        } catch (err) {
            error.value = err.response?.data?.message || 'Something went wrong';
            throw err;
        } finally {
            loading.value = false;
        }
        
    };
    return { loading, error, placeOrder };
}