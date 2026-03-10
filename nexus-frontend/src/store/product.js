import { defineStore } from "pinia";
import { ref } from "vue";

export const useProductStore = defineStore('product', () => {
    const searchQuery = ref('');
    const min_price = ref(null);
    const max_price = ref(null);

    function resetFilters() {
        searchQuery.value = '';
        min_price.value = null;
        max_price.value = null;
    }
    return { searchQuery, max_price, min_price, resetFilters };
})