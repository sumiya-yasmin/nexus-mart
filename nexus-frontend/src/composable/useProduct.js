import { fetchProductBySlug, fetchProducts } from "@/api/productService";
import { useProductStore } from "@/store/product";
import { ref } from "vue";
import { useRoute } from "vue-router";

export function useProducts() {
  const products = ref([]);
  const loading = ref(false);
  const error = ref(null);
  const productStore = useProductStore();
  const loadProducts = async (categorySlug) => {
    console.log("Axios is about to call Laravel...");
    loading.value = true;
    try {
      const params = {
        min_price : productStore.min_price,
        max_price: productStore.max_price,
        category_slug: categorySlug,
        search: productStore.searchQuery,
      }
      const response = await fetchProducts(params);
      console.log("Laravel responded with:", response.data);
      products.value = response.data.data.data;
    } catch (error) {
      error.value = error.message || "Failed to load products";
      console.error("API Error detected:", error);
    } finally {
      loading.value = false;
    }
  };
  return {
    products,
    loading,
    error,
    loadProducts,
  };
}

export function useProductData() {
    const route = useRoute();
  const product = ref(null);
  const loading = ref(false);
  const error = ref(null);

  const loadProductData = async () => {
    loading.value = true;
      try {
          console.log("Fetching Product");
          const response = await fetchProductBySlug(route.params.slug);
                console.log("Laravel responded with:", response.data);

      product.value = response.data.data;
    } catch (error) {
          error.value = error.message || "Failed to load products";
                console.error("API Error detected:", error);

    } finally {
      loading.value = false;
    }
  };
    
    return {
    product,
    loading,
    error,
    loadProductData,
  };
}
