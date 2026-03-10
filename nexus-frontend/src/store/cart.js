import { defineStore } from "pinia";
import { computed, ref, watch } from "vue";

export const useCartStore = defineStore("cart", () => {
  //the state//the source//we grab existing data from local storage
  const localData = localStorage.getItem("nexus-cart");
  const items = ref(localData ? JSON.parse(localData) : []);
  //the getters//the calcualted values
  const totalItems = computed(() => {
    return items.value.reduce((total, item) => total + item.cart_quantity, 0);
  });

  const cartTotalPrice = computed(() => {
    return items.value.reduce(
      (total, item) => total + item.cart_quantity * item.price,
      0,
    );
  });

  const cartTotalDiscountedPrice = computed(() => {
    return items.value.reduce((total, item) => {
      const savingsPerUnit =
        item.old_price > item.price ? item.old_price - item.price : 0;

      return total + item.cart_quantity * savingsPerUnit;
    }, 0);
  });

  //actions
  const addToCart = (product, qty) => {
    const existing = items.value.find((item) => item.id === product.id);
    const currentQtyInCart = existing ? existing.cart_quantity : 0;
    const totalQty = currentQtyInCart + qty;
    if (totalQty > product.quantity) {
      alert(
        `You already have ${currentQtyInCart} in cart. We only have ${product.quantity} total in stock!`,
      );
      return;
    }
    if (existing) {
      existing.cart_quantity = totalQty;
    } else {
      items.value.push({ ...product, cart_quantity: qty });
    }
  };
  const removeFromCart = (product) => {
    items.value = items.value.filter((item) => item.id != product.id);
  };
  const clearCart = () => {
    items.value = [];
  };
  watch(
    items,
    (newVal) => {
      localStorage.setItem("nexus-cart", JSON.stringify(newVal));
    },
    { deep: true },
  );

  return {
    items,
    totalItems,
    cartTotalPrice,
    cartTotalDiscountedPrice,
    addToCart,
    removeFromCart,
    clearCart,
  };
});
