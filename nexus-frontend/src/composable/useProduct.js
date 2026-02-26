import { fetchProducts } from "@/api/productService";
import { ref } from "vue";

export function useProducts() {
    const products = ref([]);
    const loading = ref(false);
    const error = ref(null);
    const loadProducts = async () => {
        console.log("Axios is about to call Laravel...");
        loading.value = true;
        try {
            const response = await fetchProducts();
            console.log("Laravel responded with:", response.data);
            products.value = response.data.data;
        } catch (error) {
            error.value = error.message || 'Failed to load products';
            console.error("API Error detected:", error);
        } finally {
            loading.value = false;
        }
    };
    return {
        products,
        loading,
        error,
        loadProducts
    };
}