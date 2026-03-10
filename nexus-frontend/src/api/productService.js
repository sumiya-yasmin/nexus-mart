import client from "./client";

export const fetchProducts = (params) => client.get('/products', {params});
export const fetchProductBySlug = (slug) => client.get(`/product/${slug}`);