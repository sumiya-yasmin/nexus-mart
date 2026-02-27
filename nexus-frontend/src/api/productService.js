import client from "./client";

export const fetchProducts = () => client.get('/products');
export const fetchProductBySlug = (slug) => client.get(`/product/${slug}`);