import client from "./client";

export const fetchProducts = () => client.get('/products');
export const fetchCategories = () => client.get('/categories');