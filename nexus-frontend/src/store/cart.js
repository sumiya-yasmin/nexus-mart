import { defineStore } from "pinia";
import { computed, ref, watch } from "vue";

export const useCartStore = defineStore('cart', () => {
    //the state//the source//we grab existing data from local storage
    const localData = localStorage.getItem('nexus-cart');
    const items = ref(localData ? JSON.parse(localData) : []);
    //the getters//the calcualted values
    const totalItems = computed(() => {
        return items.value.reduce((total, item) => total + item.quantity, 0);
    });
    const cartTotalPrice = computed(() => {
        return items.value.reduce((total, item) => total + (item.quantity * item.price),0);
    })

    //actions
    const addToCart = (product, qty) => {
        const existing = items.value.find((item) => item.id === product.id);
        if (existing) {
            existing.quantity += qty;
        } else {
            items.value.push({...product, quantity: qty});
        }
    }
    const removeFromCart = (product) => {
        items.value = items.value.filter((item) => item.id != product.id);
    }
    watch(items, (newVal) => {
        localStorage.setItem('nexus-cart', JSON.stringify(newVal));
    }, { deep: true });

    return { items, totalItems, cartTotalPrice, addToCart, removeFromCart };
})