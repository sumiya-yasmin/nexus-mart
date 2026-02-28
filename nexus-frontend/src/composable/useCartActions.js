import { useCartStore } from "@/store/cart";
import { useToast } from "vue-toastification";

export const useCartActions = () => {
  const cartStore = useCartStore();
  const toast = useToast();
  const addToCartWithNotify = (p, q = 1) => {
      cartStore.addToCart(p, q);
    toast.success(`${p.name} added to the cart`, {
      timeout: 2000,
      position: "bottom-right",
    });
  };
    const removeFromCartWithNotify = (p) => {
        cartStore.removeFromCart(p);
        toast.success(`${p.name} is removed from the cart`, {
      timeout: 2000,
      position: "top-right",
    });
    }
    return { addToCartWithNotify, removeFromCartWithNotify };
};
