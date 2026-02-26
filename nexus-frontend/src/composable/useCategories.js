import { fetchCategories } from "@/api/categoryService";
import { ref } from "vue";

export function useCategories(){
    const categories = ref([]);
    const loading = ref(false);
    const error = ref(null);
    const loadCategories = async () => {
        loading.value = true;
        try {
            const response = await fetchCategories();
            categories.value = response.data.data;
        } catch (error) {
            error.value = error.message || 'Failed to load products';
            console.error("API Error detected:", error);
        } finally {
            loading.value = false;
        }
    };
    return {
        categories, loading,error, loadCategories
    }
}