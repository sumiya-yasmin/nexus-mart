import { defineStore } from "pinia";
import { ref } from "vue";

export const useProductStore = defineStore('product', () => {
    const searchQuery = ref('');
    return { searchQuery };
})